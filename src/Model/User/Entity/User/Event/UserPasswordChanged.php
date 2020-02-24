<?php

declare(strict_types=1);


namespace Myks92\User\Model\User\Entity\User\Event;


use DateTimeImmutable;
use Myks92\User\Model\User\Entity\User\Id;

/**
 * Event User Password Changed
 *
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class UserPasswordChanged
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
     * @param Id $id
     * @param DateTimeImmutable $date
     */
    public function __construct(Id $id, DateTimeImmutable $date)
    {
        $this->id = $id;
        $this->date = $date;
    }
}