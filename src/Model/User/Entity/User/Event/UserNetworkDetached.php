<?php

declare(strict_types=1);


namespace Myks92\User\Model\User\Entity\User\Event;


use Myks92\User\Model\User\Entity\User\Id;

/**
 * Event User Network Detached
 *
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class UserNetworkDetached
{
    /**
     * @var Id
     */
    private Id $id;
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
     * @param string $network
     * @param string $identity
     */
    public function __construct(Id $id, string $network, string $identity)
    {
        $this->id = $id;
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