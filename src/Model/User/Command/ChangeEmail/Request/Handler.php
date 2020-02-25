<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\Command\ChangeEmail\Request;

use DateTimeImmutable;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use DomainException;
use Exception;
use Myks92\User\Model\FlusherInterface;
use Myks92\User\Model\User\Entity\User\Email;
use Myks92\User\Model\User\Entity\User\Id;
use Myks92\User\Model\User\Entity\User\UserRepositoryInterface;
use Myks92\User\Model\User\Service\NewEmailConfirmTokenSenderInterface;
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
     * @var TokenizerInterface
     */
    private TokenizerInterface $tokenizer;
    /**
     * @var NewEmailConfirmTokenSenderInterface
     */
    private NewEmailConfirmTokenSenderInterface $sender;
    /**
     * @var FlusherInterface
     */
    private FlusherInterface $flusher;

    /**
     * @param UserRepositoryInterface $users
     * @param TokenizerInterface $tokenizer
     * @param NewEmailConfirmTokenSenderInterface $sender
     * @param FlusherInterface $flusher
     */
    public function __construct(
        UserRepositoryInterface $users,
        TokenizerInterface $tokenizer,
        NewEmailConfirmTokenSenderInterface $sender,
        FlusherInterface $flusher
    ) {
        $this->users = $users;
        $this->tokenizer = $tokenizer;
        $this->sender = $sender;
        $this->flusher = $flusher;
    }

    /**
     * @param Command $command
     *
     * @throws Exception
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function handle(Command $command): void
    {
        $user = $this->users->get(new Id($command->id));

        $email = new Email($command->email);

        if ($this->users->hasByEmail($email)) {
            throw new DomainException('ChangeEmail is already in use.');
        }

        $date = new DateTimeImmutable();

        $user->requestEmailChanging(
            $token = $this->tokenizer->generate($date),
            $date,
            $email
        );

        $this->flusher->flush();

        $this->sender->send($email, $token);
    }
}
