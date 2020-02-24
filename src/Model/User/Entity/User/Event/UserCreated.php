<?php

declare(strict_types=1);


namespace Myks92\User\Model\User\Entity\User\Event;


use DateTimeImmutable;
use Myks92\User\Model\User\Entity\User\Email;
use Myks92\User\Model\User\Entity\User\Id;
use Myks92\User\Model\User\Entity\User\Name;

/**
 * Event User Created
 *
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class UserCreated
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
     * @param Id $id
     * @param DateTimeImmutable $date
     * @param Name $name
     * @param Email $email
     */
    public function __construct(Id $id, DateTimeImmutable $date, Name $name, Email $email)
    {
        $this->id = $id;
        $this->date = $date;
        $this->name = $name;
        $this->email = $email;
    }
}