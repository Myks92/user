<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\UseCase\Reset\Request;

use DateTimeImmutable;
use Exception;
use Myks92\User\Model\FlusherInterface;
use Myks92\User\Model\User\Entity\User\Email;
use Myks92\User\Model\User\Entity\User\UserRepositoryInterface;
use Myks92\User\Model\User\Service\ResetTokenSenderInterface;
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
     * @var FlusherInterface
     */
    private FlusherInterface $flusher;
    /**
     * @var ResetTokenSenderInterface
     */
    private ResetTokenSenderInterface $sender;

    /**
     * @param UserRepositoryInterface $users
     * @param TokenizerInterface $tokenizer
     * @param FlusherInterface $flusher
     * @param ResetTokenSenderInterface $sender
     */
    public function __construct(
        UserRepositoryInterface $users,
        TokenizerInterface $tokenizer,
        FlusherInterface $flusher,
        ResetTokenSenderInterface $sender
    ) {
        $this->users = $users;
        $this->tokenizer = $tokenizer;
        $this->flusher = $flusher;
        $this->sender = $sender;
    }

    /**
     * @param Command $command
     *
     * @throws Exception
     */
    public function handle(Command $command): void
    {
        $user = $this->users->getByEmail(new Email($command->email));

        $date = new DateTimeImmutable();
        $user->requestPasswordReset($this->tokenizer->generate($date), new DateTimeImmutable());

        $this->flusher->flush();

        $this->sender->send($user->getEmail(), $user->getResetToken());
    }
}
