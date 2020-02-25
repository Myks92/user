<?php

declare(strict_types=1);


namespace Myks92\User\Model\User\Entity\User\Event;


use Myks92\User\Model\User\Entity\User\Email;
use Myks92\User\Model\User\Entity\User\Id;
use Myks92\User\Model\User\Entity\User\Token;

/**
 * Event User ChangeEmail Changing Requested
 *
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class UserEmailChangingRequested
{
    /**
     * @var Id
     */
    private Id $id;
    /**
     * @var Email
     */
    private Email $email;
    /**
     * @var Token
     */
    private Token $token;

    /**
     * @param Id $id
     * @param Email $email
     * @param Token $token
     */
    public function __construct(Id $id, Email $email, Token $token)
    {
        $this->id = $id;
        $this->email = $email;
        $this->token = $token;
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @return Token
     */
    public function getToken(): Token
    {
        return $this->token;
    }
}