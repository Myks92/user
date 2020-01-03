<?php
declare(strict_types=1);

namespace Myks92\User\Model\User\Service;


use Myks92\User\Model\User\Entity\User\Email;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
interface NewEmailConfirmTokenSenderInterface
{
    /**
     * @param Email $email
     * @param string $token
     */
    public function send(Email $email, string $token): void;
}