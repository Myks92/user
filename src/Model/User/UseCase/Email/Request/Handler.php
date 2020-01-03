<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\UseCase\Email\Request;

use Exception;
use Myks92\User\Model\Flusher;
use Myks92\User\Model\User\Entity\User\Email;
use Myks92\User\Model\User\Entity\User\Id;
use Myks92\User\Model\User\Entity\User\UserRepository;
use Myks92\User\Model\User\Entity\User\UserRepositoryInterface;
use Myks92\User\Model\User\Service\NewEmailConfirmTokenizerInterface;
use Myks92\User\Model\User\Service\NewEmailConfirmTokenSenderInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use DomainException;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class Handler
{
    private $users;
    private $tokenizer;
    private $sender;
    private $flusher;

    /**
     * @param UserRepositoryInterface $users
     * @param NewEmailConfirmTokenizerInterface $tokenizer
     * @param NewEmailConfirmTokenSenderInterface $sender
     * @param Flusher $flusher
     */
    public function __construct(
        UserRepositoryInterface $users,
        NewEmailConfirmTokenizerInterface $tokenizer,
        NewEmailConfirmTokenSenderInterface $sender,
        Flusher $flusher
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
            throw new DomainException('Email is already in use.');
        }

        $user->requestEmailChanging($email, $token = $this->tokenizer->generate());

        $this->flusher->flush();

        $this->sender->send($email, $token);
    }
}
