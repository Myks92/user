<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\UseCase\Reset\Reset;

use Myks92\User\Model\Flusher;
use Myks92\User\Model\User\Entity\User\UserRepository;
use Myks92\User\Model\User\Entity\User\UserRepositoryInterface;
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
    private $flusher;

    /**
     * @param UserRepositoryInterface $users
     * @param PasswordHasherInterface $hasher
     * @param Flusher $flusher
     */
    public function __construct(UserRepositoryInterface $users, PasswordHasherInterface $hasher, Flusher $flusher)
    {
        $this->users = $users;
        $this->hasher = $hasher;
        $this->flusher = $flusher;
    }

    /**
     * @param Command $command
     *
     * @throws Exception
     */
    public function handle(Command $command): void
    {
        if (!$user = $this->users->findByResetToken($command->token)) {
            throw new DomainException('Incorrect or confirmed token.');
        }

        $user->passwordReset(new DateTimeImmutable(), $this->hasher->hash($command->password));

        $this->flusher->flush();
    }
}
