<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\UseCase\SignUp\Confirm\ByToken;

use Myks92\User\Model\Flusher;
use Myks92\User\Model\User\Entity\User\UserRepository;
use DomainException;
use Myks92\User\Model\User\Entity\User\UserRepositoryInterface;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class Handler
{
    private $users;
    private $flusher;

    /**
     * @param UserRepositoryInterface $users
     * @param Flusher $flusher
     */
    public function __construct(UserRepositoryInterface $users, Flusher $flusher)
    {
        $this->users = $users;
        $this->flusher = $flusher;
    }

    /**
     * @param Command $command
     */
    public function handle(Command $command): void
    {
        if (!$user = $this->users->findByConfirmToken($command->token)) {
            throw new DomainException('Incorrect or confirmed token.');
        }

        $user->confirmSignUp();

        $this->flusher->flush();
    }
}
