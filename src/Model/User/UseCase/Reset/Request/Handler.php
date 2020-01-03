<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\UseCase\Reset\Request;

use Myks92\User\Model\Flusher;
use Myks92\User\Model\User\Entity\User\Email;
use Myks92\User\Model\User\Entity\User\UserRepository;
use Myks92\User\Model\User\Entity\User\UserRepositoryInterface;
use Myks92\User\Model\User\Service\ResetTokenizer;
use Myks92\User\Model\User\Service\ResetTokenSenderInterface;
use DateTimeImmutable;
use Exception;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class Handler
{
    private $users;
    private $tokenizer;
    private $flusher;
    private $sender;

    /**
     * @param UserRepositoryInterface $users
     * @param ResetTokenizer $tokenizer
     * @param Flusher $flusher
     * @param ResetTokenSenderInterface $sender
     */
    public function __construct(
        UserRepositoryInterface $users,
        ResetTokenizer $tokenizer,
        Flusher $flusher,
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

        $user->requestPasswordReset($this->tokenizer->generate(), new DateTimeImmutable());

        $this->flusher->flush();

        $this->sender->send($user->getEmail(), $user->getResetToken());
    }
}
