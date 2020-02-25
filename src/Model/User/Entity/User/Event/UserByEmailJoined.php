<?php

declare(strict_types=1);


namespace Myks92\User\Model\User\Entity\User\Event;


use DateTimeImmutable;
use Myks92\User\Model\User\Entity\User\Email;
use Myks92\User\Model\User\Entity\User\Id;
use Myks92\User\Model\User\Entity\User\Name;
use Myks92\User\Model\User\Entity\User\Token;

/**
 * Event User By Email Registered
 *
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class UserByEmailJoined
{
    /**
     * @var Id
     */
    public Id $id;
    /**
     * @var DateTimeImmutable
     */
    public DateTimeImmutable $date;
    /**
     * @var Name
     */
    public Name $name;
    /**
     * @var Email
     */
    public Email $email;
    /**
     * @var Token
     */
    public Token $token;

    /**
     * @param Id $id
     * @param DateTimeImmutable $date
     * @param Name $name
     * @param Email $email
     * @param Token $token
     */
    public function __construct(Id $id, DateTimeImmutable $date, Name $name, Email $email, Token $token)
    {
        $this->id = $id;
        $this->date = $date;
        $this->name = $name;
        $this->email = $email;
        $this->token = $token;
    }
}