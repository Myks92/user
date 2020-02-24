<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\UseCase\Edit;

use Myks92\User\Model\User\Entity\User\User;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class Command
{
    /**
     * @Assert\NotBlank()
     */
    public string $id;
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    public string $email;
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public string $firstName;
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public string $lastName;

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
        $command->email = $user->getEmail() ? $user->getEmail()->getValue() : null;
        $command->firstName = $user->getName()->getFirst();
        $command->lastName = $user->getName()->getLast();
        return $command;
    }
}
