<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\UseCase\SignUp\Confirm\Manual;

use DateTimeImmutable;
use Exception;
use Myks92\User\Model\FlusherInterface;
use Myks92\User\Model\User\Entity\User\Id;
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
        $user = $this->users->get(new Id($command->id));

        $date = new DateTimeImmutable();

        $user->confirmSignUp(
            $user->getConfirmToken()->getValue(),
            $date
        );

        $this->flusher->flush();
    }
}
