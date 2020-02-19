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
class UserByNetworkRegistered
{
    /**
     * @var Id
     */
    public $id;
    /**
     * @var DateTimeImmutable
     */
    public $date;
    /**
     * @var Name
     */
    public $name;
    /**
     * @var string
     */
    public $network;
    /**
     * @var string
     */
    public $identity;

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