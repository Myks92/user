<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\Command\ChangeRole;

use Myks92\User\Model\User\Entity\User\User;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class Command
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public string $id;
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public string $role;

    /**
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @param User $user
     *
     * @return static
     */
    public static function fromUser(User $user): self
    {
        $command = new self($user->getId()->getValue());
        $command->role = $user->getRole()->getName();
        return $command;
    }
}
