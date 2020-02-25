<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\Command\ResetPassword\Confirm;

use DateTimeImmutable;
use DomainException;
use Exception;
use Myks92\User\Model\FlusherInterface;
use Myks92\User\Model\User\Entity\User\UserRepositoryInterface;
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
     * @var FlusherInterface
     */
    private FlusherInterface $flusher;

    /**
     * @param UserRepositoryInterface $users
     * @param PasswordHasherInterface $hasher
     * @param FlusherInterface $flusher
     */
    public function __construct(
        UserRepositoryInterface $users,
        PasswordHasherInterface $hasher,
        FlusherInterface $flusher
    ) {
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
            throw new DomainException('Token is not found.');
        }

        $user->resetPassword($command->token, new DateTimeImmutable(), $this->hasher->hash($command->password));

        $this->flusher->flush();
    }
}
