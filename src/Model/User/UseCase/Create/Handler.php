<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\UseCase\Create;

use DateTimeImmutable;
use DomainException;
use Exception;
use Myks92\User\Model\FlusherInterface;
use Myks92\User\Model\User\Entity\User\Email;
use Myks92\User\Model\User\Entity\User\Id;
use Myks92\User\Model\User\Entity\User\Name;
use Myks92\User\Model\User\Entity\User\User;
use Myks92\User\Model\User\Entity\User\UserRepositoryInterface;
use Myks92\User\Model\User\Service\PasswordGeneratorInterface;
use Myks92\User\Model\User\Service\PasswordHasherInterface;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class Handler
{
    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $users;
    /**
     * @var PasswordHasherInterface
     */
    private PasswordHasherInterface $hasher;
    /**
     * @var PasswordGeneratorInterface
     */
    private PasswordGeneratorInterface $generator;
    /**
     * @var FlusherInterface
     */
    private FlusherInterface $flusher;

    /**
     * @param UserRepositoryInterface $users
     * @param PasswordHasherInterface $hasher
     * @param PasswordGeneratorInterface $generator
     * @param FlusherInterface $flusher
     */
    public function __construct(
        UserRepositoryInterface $users,
        PasswordHasherInterface $hasher,
        PasswordGeneratorInterface $generator,
        FlusherInterface $flusher
    ) {
        $this->users = $users;
        $this->hasher = $hasher;
        $this->generator = $generator;
        $this->flusher = $flusher;
    }

    /**
     * @param Command $command
     *
     * @throws Exception
     */
    public function handle(Command $command): void
    {
        $email = new Email($command->email);

        if ($this->users->hasByEmail($email)) {
            throw new DomainException('User with this email already exists.');
        }

        $user = User::create(
            Id::generate(),
            new DateTimeImmutable(),
            new Name($command->firstName, $command->lastName),
            $email,
            $this->hasher->hash($this->generator->generate())
        );

        $this->users->add($user);

        $this->flusher->flush();
    }
}
