<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\UseCase\Network\Auth;

use DateTimeImmutable;
use DomainException;
use Exception;
use Myks92\User\Model\FlusherInterface;
use Myks92\User\Model\User\Entity\User\Id;
use Myks92\User\Model\User\Entity\User\Name;
use Myks92\User\Model\User\Entity\User\User;
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
        if ($this->users->hasByNetworkIdentity($command->network, $command->identity)) {
            throw new DomainException('User already exists.');
        }

        $user = User::signUpByNetwork(
            Id::next(),
            new DateTimeImmutable(),
            new Name($command->firstName, $command->lastName),
            $command->network,
            $command->identity
        );

        $this->users->add($user);

        $this->flusher->flush();
    }
}
