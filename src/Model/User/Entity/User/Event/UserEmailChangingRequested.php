<?php

declare(strict_types=1);


namespace Myks92\User\Model\User\Entity\User\Event;


use Myks92\User\Model\User\Entity\User\Email;
use Myks92\User\Model\User\Entity\User\Id;

/**
 * Event User Email Changing Requested
 *
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class UserEmailChangingRequested
{
    /**
     * @var Id
     */
    public $id;
    /**
     * @var Email
     */
    public $email;
    /**
     * @var string
     */
    public $token;

    /**
     * @param Id $id
     * @param Email $email
     * @param string $token
     */
    public function __construct(Id $id, Email $email, string $token)
    {
        $this->id = $id;
        $this->email = $email;
        $this->token = $token;
    }
}