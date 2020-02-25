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
    private Id $id;
    /**
     * @var DateTimeImmutable
     */
    private DateTimeImmutable $date;
    /**
     * @var Name
     */
    private Name $name;
    /**
     * @var string
     */
    private string $network;
    /**
     * @var string
     */
    private string $identity;

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

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getNetwork(): string
    {
        return $this->network;
    }

    /**
     * @return string
     */
    public function getIdentity(): string
    {
        return $this->identity;
    }

}