<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\Command\JoinByEmail\Confirm;

use DateTimeImmutable;
use DomainException;
use Exception;
use Myks92\User\Model\FlusherInterface;
use Myks92\User\Model\User\Entity\User\UserRepositoryInterface;

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
     * @var FlusherInterface
     */
    private FlusherInterface $flusher;

    /**
     * @param UserRepositoryInterface $users
     * @param FlusherInterface $flusher
     */
    public function __construct(UserRepositoryInterface $users, FlusherInterface $flusher)
    {
        $this->users = $users;
        $this->flusher = $flusher;
    }

    /**
     * @param Command $command
     *
     * @throws Exception
     */
    public function handle(Command $command): void
    {
        if (!$user = $this->users->findByConfirmToken($command->token)) {
            throw new DomainException('Incorrect or confirmed token.');
        }

        $date = new DateTimeImmutable();
        $user->confirmJoin($command->token, $date);

        $this->flusher->flush();
    }
}
