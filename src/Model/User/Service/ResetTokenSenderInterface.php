<?php
declare(strict_types=1);

namespace Myks92\User\Model\User\Service;


use Myks92\User\Model\User\Entity\User\Email;
use Myks92\User\Model\User\Entity\User\ResetToken;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
interface ResetTokenSenderInterface
{
    /**
     * @param Email $email
     * @param ResetToken $token
     */
    public function send(Email $email, ResetToken $token): void;
}