<?php

declare(strict_types=1);


namespace Myks92\User\Model\User\Entity\User\Event;


use DateTimeImmutable;
use Myks92\User\Model\User\Entity\User\Id;
use Myks92\User\Model\User\Entity\User\Name;

/**
 * Event User By Network Registered
 *
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class UserByNetworkJoined
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
     * @var string
     */
    public string $network;
    /**
     * @var string
     */
    public string $identity;

    /**
     * @param Id $id
     * @param DateTimeImmutable $date
     * @param Name $name
     * @param string $network
     * @param string $identity
     */
    public function __construct(Id $id, DateTimeImmutable $date, Name $name, string $network, string $identity)
    {
        $this->id = $id;
        $this->date = $date;
        $this->name = $name;
        $this->network = $network;
        $this->identity = $identity;
    }
}