<?php

declare(strict_types=1);


namespace Myks92\User\Model\User\Entity\User\Event;


use DateTimeImmutable;
use Myks92\User\Model\User\Entity\User\Id;
use Myks92\User\Model\User\Entity\User\Token;

/**
 * Event User Password Changing Requested
 *
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class UserPasswordChangingRequested
{
    /**
     * @var Id
     */
    public Id $id;
    /**
     * @var Token
     */
    public Token $token;
    /**
     * @var DateTimeImmutable|DateTimeImmutable
     */
    public DateTimeImmutable $date;

    /**
     * @param Id $id
     * @param Token $token
     * @param DateTimeImmutable $date
     */
    public function __construct(Id $id, Token $token, DateTimeImmutable $date)
    {
        $this->id = $id;
        $this->token = $token;
        $this->date = $date;
    }
}