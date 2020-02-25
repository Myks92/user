<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\Command\JoinByNetwork;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class Command
{
    /**
     * @var string
     */
    public string $network;
    /**
     * @var string
     */
    public string $identity;
    /**
     * @var string
     */
    public string $firstName;
    /**
     * @var string
     */
    public string $lastName;

    /**
     * @param string $network
     * @param string $identity
     */
    public function __construct(string $network, string $identity)
    {
        $this->network = $network;
        $this->identity = $identity;
    }
}
