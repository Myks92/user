<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\UseCase\Create;

use Myks92\User\Model\Flusher;
use Myks92\User\Model\User\Entity\User\Email;
use Myks92\User\Model\User\Entity\User\Id;
use Myks92\User\Model\User\Entity\User\Name;
use Myks92\User\Model\User\Entity\User\User;
use Myks92\User\Model\User\Entity\User\UserRepository;
use Myks92\User\Model\User\Entity\User\UserRepositoryInterface;
use Myks92\User\Model\User\Service\PasswordGenerator;
use Myks92\User\Model\User\Service\PasswordHasherInterface;
use DateTimeImmutable;
use DomainException;
use Exception;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class Handler
{
    private $users;
    private $hasher;
    private $generator;
    private $flusher;

    /**
     * @param UserRepositoryInterface $users
     * @param PasswordHasherInterface $hasher
     * @param PasswordGenerator $generator
     * @param Flusher $flusher
     */
    public function __construct(
        UserRepositoryInterface $users,
        PasswordHasherInterface $hasher,
        PasswordGenerator $generator,
        Flusher $flusher
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
            Id::next(),
            new DateTimeImmutable(),
            new Name($command->firstName, $command->lastName),
            $email,
            $this->hasher->hash($this->generator->generate())
        );

        $this->users->add($user);

        $this->flusher->flush();
    }
}
