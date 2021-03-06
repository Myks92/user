<?php

declare(strict_types=1);


namespace Myks92\User\Model\User\Command\Remove;


use Myks92\User\Model\Flusher;
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
     * @var Flusher
     */
    private Flusher $flusher;

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
        $user = $this->users->get(new Id($command->id));

        $user->remove();

        $this->users->remove($user);

        $this->flusher->flush();
    }
}