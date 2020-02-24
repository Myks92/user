<?php

declare(strict_types=1);


namespace Myks92\User\Model\User\Entity\User\Event;


use DateTimeImmutable;
use Myks92\User\Model\User\Entity\User\Id;
use Myks92\User\Model\User\Entity\User\ResetToken;

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
     * @var ResetToken
     */
    public ResetToken $token;
    /**
     * @var DateTimeImmutable|DateTimeImmutable
     */
    public DateTimeImmutable $date;

    /**
     * @param Id $id
     * @param ResetToken $token
     * @param DateTimeImmutable $date
     */
    public function __construct(Id $id, ResetToken $token, DateTimeImmutable $date)
    {
        $this->id = $id;
        $this->token = $token;
        $this->date = $date;
    }
}