<?php

declare(strict_types=1);


namespace Myks92\User\Model\User\Entity\User\Event;


use Myks92\User\Model\User\Entity\User\Id;

/**
 * Event User Network Attached
 *
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class UserNetworkAttached
{
    /**
     * @var Id
     */
    public Id $id;
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
     * @param string $network
     * @param string $identity
     */
    public function __construct(Id $id, string $network, string $identity)
    {
        $this->id = $id;
        $this->network = $network;
        $this->identity = $identity;
    }
}