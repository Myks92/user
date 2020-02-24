<?php

declare(strict_types=1);

namespace Myks92\User\Tests\Builder\User;

use BadMethodCallException;
use DateTimeImmutable;
use Myks92\User\Model\User\Entity\User\Email;
use Myks92\User\Model\User\Entity\User\Id;
use Myks92\User\Model\User\Entity\User\Name;
use Myks92\User\Model\User\Entity\User\Role;
use Myks92\User\Model\User\Entity\User\User;

class UserBuilder
{
    private Id $id;
    private DateTimeImmutable $date;
    private Name $name;
    private ?Email $email = null;
    private string $hash;
    private string $token;
    private bool $confirmed = false;

    private ?string $network = null;
    private ?string $identity = null;

    private ?Role $role = null;

    public function __construct()
    {
        $this->id = Id::next();
        $this->date = new DateTimeImmutable();
        $this->name = new Name('First', 'Last');
    }

    public function viaEmail(Email $email = null, string $hash = null, string $token = null): self
    {
        $clone = clone $this;
        $clone->email = $email ?? new Email('mail@app.test');
        $clone->hash = $hash ?? 'hash';
        $clone->token = $token ?? 'token';
        return $clone;
    }

    public function confirmed(): self
    {
        $clone = clone $this;
        $clone->confirmed = true;
        return $clone;
    }

    public function viaNetwork(string $network = null, string $identity = null): self
    {
        $clone = clone $this;
        $clone->network = $network ?? 'vk';
        $clone->identity = $identity ?? '0001';
        return $clone;
    }

    public function withId(Id $id): self
    {
        $clone = clone $this;
        $clone->id = $id;
        return $clone;
    }

    public function withName(Name $name): self
    {
        $clone = clone $this;
        $clone->name = $name;
        return $clone;
    }

    public function withRole(Role $role): self
    {
        $clone = clone $this;
        $clone->role = $role;
        return $clone;
    }

    public function build(): User
    {
        $user = null;

        if ($this->email) {
            $user = User::signUpByEmail(
                $this->id,
                $this->date,
                $this->name,
                $this->email,
                $this->hash,
                $this->token
            );

            if ($this->confirmed) {
                $user->confirmSignUp();
            }
        }

        if ($this->network) {
            $user = User::signUpByNetwork(
                $this->id,
                $this->date,
                $this->name,
                $this->network,
                $this->identity
            );
        }

        if (!$user) {
            throw new BadMethodCallException('Specify via method.');
        }

        if ($this->role) {
            $user->changeRole($this->role);
        }

        return $user;
    }
}
