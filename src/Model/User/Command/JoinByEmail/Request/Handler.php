<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\Command\JoinByEmail\Request;

use DateTimeImmutable;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use DomainException;
use Exception;
use Myks92\User\Model\FlusherInterface;
use Myks92\User\Model\User\Entity\User\Email;
use Myks92\User\Model\User\Entity\User\Id;
use Myks92\User\Model\User\Entity\User\Name;
use Myks92\User\Model\User\Entity\User\User;
use Myks92\User\Model\User\Entity\User\UserRepositoryInterface;
use Myks92\User\Model\User\Service\JoinConfirmTokenSenderInterface;
use Myks92\User\Model\User\Service\PasswordHasherInterface;
use Myks92\User\Model\User\Service\TokenizerInterface;

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
     * @var TokenizerInterface
     */
    private TokenizerInterface $tokenizer;
    /**
     * @var JoinConfirmTokenSenderInterface
     */
    private JoinConfirmTokenSenderInterface $sender;
    /**
     * @var FlusherInterface
     */
    private FlusherInterface $flusher;

    /**
     * @param UserRepositoryInterface $users
     * @param PasswordHasherInterface $hasher
     * @param TokenizerInterface $tokenizer
     * @param JoinConfirmTokenSenderInterface $sender
     * @param FlusherInterface $flusher
     */
    public function __construct(
        UserRepositoryInterface $users,
        PasswordHasherInterface $hasher,
        TokenizerInterface $tokenizer,
        JoinConfirmTokenSenderInterface $sender,
        FlusherInterface $flusher
    ) {
        $this->users = $users;
        $this->hasher = $hasher;
        $this->tokenizer = $tokenizer;
        $this->sender = $sender;
        $this->flusher = $flusher;
    }

    /**
     * @param Command $command
     *
     * @throws NoResultException
     * @throws NonUniqueResultException
     * @throws Exception
     */
    public function handle(Command $command): void
    {
        $email = new Email($command->email);

        if ($this->users->hasByEmail($email)) {
            throw new DomainException('User already exists.');
        }

        $date = new DateTimeImmutable();

        $user = User::requestJoinByEmail(
            Id::generate(),
            new DateTimeImmutable(),
            new Name($command->firstName, $command->lastName),
            $email,
            $this->hasher->hash($command->password),
            $token = $this->tokenizer->generate($date)
        );

        $this->users->add($user);

        $this->sender->send($email, $token);

        $this->flusher->flush();
    }
}
