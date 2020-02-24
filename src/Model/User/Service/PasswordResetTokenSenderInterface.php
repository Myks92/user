<?php
declare(strict_types=1);

namespace Myks92\User\Model\User\Service;


use Myks92\User\Model\User\Entity\User\Email;
use Myks92\User\Model\User\Entity\User\Token;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
interface PasswordResetTokenSenderInterface
{
    /**
     * @param Email $email
     * @param Token $token
     */
    public function send(Email $email, Token $token): void;
}