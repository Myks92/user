<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\Entity\User;

use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use DomainException;
use Exception;
use Myks92\User\Model\AggregateRoot;
use Myks92\User\Model\EventsTrait;
use Myks92\User\Model\User\Entity\User\Event\UserActivated;
use Myks92\User\Model\User\Entity\User\Event\UserBlocked;
use Myks92\User\Model\User\Entity\User\Event\UserByEmailJoined;
use Myks92\User\Model\User\Entity\User\Event\UserByNetworkJoined;
use Myks92\User\Model\User\Entity\User\Event\UserCreated;
use Myks92\User\Model\User\Entity\User\Event\UserEdited;
use Myks92\User\Model\User\Entity\User\Event\UserEmailChanged;
use Myks92\User\Model\User\Entity\User\Event\UserEmailChangingRequested;
use Myks92\User\Model\User\Entity\User\Event\UserNameChanged;
use Myks92\User\Model\User\Entity\User\Event\UserNetworkAttached;
use Myks92\User\Model\User\Entity\User\Event\UserNetworkDetached;
use Myks92\User\Model\User\Entity\User\Event\UserPasswordChangingRequested;
use Myks92\User\Model\User\Entity\User\Event\UserPasswordResetted;
use Myks92\User\Model\User\Entity\User\Event\UserRegisterConfirmed;
use Myks92\User\Model\User\Entity\User\Event\UserRemoved;
use Myks92\User\Model\User\Entity\User\Event\UserRoleChanged;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="user_users", uniqueConstraints={
 *     @ORM\UniqueConstraint(columns={"email"}),
 *     @ORM\UniqueConstraint(columns={"reset_token_token"})
 * })
 */
class User implements AggregateRoot
{
    use EventsTrait;

    /**
     * @ORM\Column(type="user_user_id")
     * @ORM\Id
     */
    private Id $id;
    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetime_immutable")
     */
    private DateTimeImmutable $date;
    /**
     * @var Email|null
     * @ORM\Column(type="user_user_email", nullable=true)
     */
    private ?Email $email = null;
    /**
     * @var string|null
     * @ORM\Column(type="string", name="password_hash", nullable=true)
     */
    private ?string $passwordHash = null;
    /**
     * @var Token|null
     * @ORM\Embedded(class="Token", columnPrefix="join_confirm_token_")
     */
    private ?Token $joinConfirmToken = null;
    /**
     * @var Name
     * @ORM\Embedded(class="Name")
     */
    private Name $name;
    /**
     * @var Email|null
     * @ORM\Column(type="user_user_email", name="new_email", nullable=true)
     */
    private ?Email $newEmail = null;
    /**
     * @var Token|null
     * @ORM\Embedded(class="Token", columnPrefix="new_email_token_")
     */
    private ?Token $newEmailToken = null;
    /**
     * @var Token|null
     * @ORM\Embedded(class="Token", columnPrefix="password_reset_token_")
     */
    private ?Token $passwordResetToken = null;
    /**
     * @var Status
     * @ORM\Column(type="user_user_status", length=16)
     */
    private Status $status;
    /**
     * @var Role
     * @ORM\Column(type="user_user_role", length=16)
     */
    private Role $role;
    /**
     * @var Network[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="Network", mappedBy="user", orphanRemoval=true, cascade={"persist"})
     */
    private $networks;
    /**
     * @ORM\Version()
     * @ORM\Column(type="integer")
     */
    private int $version;

    /**
     * @param Id $id
     * @param DateTimeImmutable $date
     * @param Name $name
     * @param Status $status
     */
    private function __construct(Id $id, DateTimeImmutable $date, Name $name, Status $status)
    {
        $this->id = $id;
        $this->date = $date;
        $this->name = $name;
        $this->status = $status;
        $this->role = Role::user();
        $this->networks = new ArrayCollection();
    }

    /**
     * @param Id $id
     * @param DateTimeImmutable $date
     * @param Name $name
     * @param Email $email
     * @param string $hash
     *
     * @return static
     */
    public static function create(Id $id, DateTimeImmutable $date, Name $name, Email $email, string $hash): self
    {
        $user = new self($id, $date, $name, Status::active());
        $user->email = $email;
        $user->passwordHash = $hash;
        $user->recordEvent(new UserCreated($id, $date, $name, $email));
        return $user;
    }

    /**
     * @param Id $id
     * @param DateTimeImmutable $date
     * @param Name $name
     * @param Email $email
     * @param string $hash
     * @param Token $token
     *
     * @return static
     */
    public static function requestJoinByEmail(
        Id $id,
        DateTimeImmutable $date,
        Name $name,
        Email $email,
        string $hash,
        Token $token
    ): self {
        $user = new self($id, $date, $name, Status::wait());
        $user->email = $email;
        $user->passwordHash = $hash;
        $user->joinConfirmToken = $token;
        $user->recordEvent(new UserByEmailJoined($id, $date, $name, $email, $token));
        return $user;
    }

    /**
     * @param Id $id
     * @param DateTimeImmutable $date
     * @param Name $name
     * @param string $network
     * @param string $identity
     *
     * @return static
     * @throws Exception
     */
    public static function joinByNetwork(
        Id $id,
        DateTimeImmutable $date,
        Name $name,
        string $network,
        string $identity
    ): self {
        $user = new self($id, $date, $name, Status::active());
        $user->attachNetwork($network, $identity);
        $user->recordEvent(new UserByNetworkJoined($id, $date, $name, $network, $identity));
        return $user;
    }

    /**
     * @param string $network
     * @param string $identity
     *
     * @throws Exception
     */
    public function attachNetwork(string $network, string $identity): void
    {
        foreach ($this->networks as $existing) {
            if ($existing->isForNetwork($network)) {
                throw new DomainException('Network is already attached.');
            }
        }
        $this->networks->add(new Network($this, $network, $identity));
        $this->recordEvent(new UserNetworkAttached($this->id, $network, $identity));
    }

    public function confirmJoin(string $token, DateTimeImmutable $date): void
    {
        if ($this->joinConfirmToken === null) {
            throw new DomainException('Confirmation is not required.');
        }
        $this->joinConfirmToken->validate($token, $date);
        $this->status = Status::active();
        $this->joinConfirmToken = null;
        $this->recordEvent(new UserRegisterConfirmed($this->id, $this->status));
    }

    /**
     * @param string $network
     * @param string $identity
     */
    public function detachNetwork(string $network, string $identity): void
    {
        foreach ($this->networks as $existing) {
            if ($existing->isFor($network, $identity)) {
                if (!$this->email && $this->networks->count() === 1) {
                    throw new DomainException('Unable to detach the last identity.');
                }
                $this->networks->removeElement($existing);
                $this->recordEvent(new UserNetworkDetached($this->id, $network, $identity));
                return;
            }
        }
        throw new DomainException('Network is not attached.');
    }

    /**
     * @param Token $token
     * @param DateTimeImmutable $date
     */
    public function requestPasswordReset(Token $token, DateTimeImmutable $date): void
    {
        if (!$this->isActive()) {
            throw new DomainException('User is not active.');
        }
        if ($this->email === null) {
            throw new DomainException('ChangeEmail is not specified.');
        }
        if ($this->passwordResetToken !== null && !$this->passwordResetToken->isExpiredTo($date)) {
            throw new DomainException('Resetting is already requested.');
        }
        $this->passwordResetToken = $token;
        $this->recordEvent(new UserPasswordChangingRequested($this->id, $token, $date));
    }

    /**
     * @param string $token
     * @param DateTimeImmutable $date
     * @param string $hash
     */
    public function confirmPasswordReset(string $token, DateTimeImmutable $date, string $hash): void
    {
        if ($this->passwordResetToken === null) {
            throw new DomainException('Resetting is not requested.');
        }
        $this->passwordResetToken->validate($token, $date);
        $this->passwordHash = $hash;
        $this->passwordResetToken = null;
        $this->recordEvent(new UserPasswordResetted($this->id, $date));
    }

    /**
     * @param Token $token
     * @param DateTimeImmutable $date
     * @param Email $email
     */
    public function requestEmailChanging(Token $token, DateTimeImmutable $date, Email $email): void
    {
        if (!$this->isActive()) {
            throw new DomainException('User is not active.');
        }
        if ($this->email !== null && $this->email->isEqual($email)) {
            throw new DomainException('ChangeEmail is already same.');
        }
        if ($this->newEmailToken !== null && !$this->newEmailToken->isExpiredTo($date)) {
            throw new DomainException('Changing is already requested.');
        }
        $this->newEmail = $email;
        $this->newEmailToken = $token;
        $this->recordEvent(new UserEmailChangingRequested($this->id, $email, $token));
    }

    /**
     * @param string $token
     * @param DateTimeImmutable $date
     */
    public function confirmEmailChanging(string $token, DateTimeImmutable $date): void
    {
        if ($this->newEmail === null || $this->newEmailToken === null) {
            throw new DomainException('Changing is not requested.');
        }
        $this->newEmailToken->validate($token, $date);
        $this->email = $this->newEmail;
        $this->newEmail = null;
        $this->newEmailToken = null;
        $this->recordEvent(new UserEmailChanged($this->id, $this->email));
    }

    /**
     * @param Name $name
     */
    public function changeName(Name $name): void
    {
        $this->name = $name;
        $this->recordEvent(new UserNameChanged($this->id, $name));
    }

    /**
     * @param Email $email
     * @param Name $name
     */
    public function edit(Email $email, Name $name): void
    {
        $this->name = $name;
        $this->email = $email;
        $this->recordEvent(new UserEdited($this->id, $name, $email));
    }

    /**
     * @param Role $role
     */
    public function changeRole(Role $role): void
    {
        if ($this->role->isEqual($role)) {
            throw new DomainException('Role is already same.');
        }
        $this->role = $role;
        $this->recordEvent(new UserRoleChanged($this->id, $role));
    }

    public function activate(): void
    {
        if ($this->isActive()) {
            throw new DomainException('User is already active.');
        }
        $this->status = Status::active();
        $this->recordEvent(new UserActivated($this->id, $this->status));
    }

    public function block(): void
    {
        if ($this->isBlocked()) {
            throw new DomainException('User is already blocked.');
        }
        $this->status = Status::blocked();
        $this->recordEvent(new UserBlocked($this->id, $this->status));
    }

    public function remove(): void
    {
        if (!$this->isWait()) {
            throw new DomainException('Unable to remove active user.');
        }
        $this->recordEvent(new UserRemoved($this->id));
    }

    /**
     * @return bool
     */
    public function isWait(): bool
    {
        return $this->status->isWait();
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->status->isActive();
    }

    /**
     * @return bool
     */
    public function isBlocked(): bool
    {
        return $this->status->isBlocked();
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @return Email|null
     */
    public function getEmail(): ?Email
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getPasswordHash(): ?string
    {
        return $this->passwordHash;
    }

    /**
     * @return Token|null
     */
    public function getJoinConfirmToken(): ?Token
    {
        return $this->joinConfirmToken;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @return Email|null
     */
    public function getNewEmail(): ?Email
    {
        return $this->newEmail;
    }

    /**
     * @return Token|null
     */
    public function getNewEmailToken(): ?Token
    {
        return $this->newEmailToken;
    }

    /**
     * @return Token|null
     */
    public function getPasswordResetToken(): ?Token
    {
        return $this->passwordResetToken;
    }

    /**
     * @return Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }

    /**
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * @return Network[]
     */
    public function getNetworks(): array
    {
        return $this->networks->toArray();
    }

    /**
     * @ORM\PostLoad()
     */
    public function checkEmbeds(): void
    {
        if ($this->passwordResetToken->isEmpty()) {
            $this->passwordResetToken = null;
        }
    }
}
