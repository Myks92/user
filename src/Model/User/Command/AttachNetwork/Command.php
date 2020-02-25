<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\Command\AttachNetwork;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class Command
{
    /**
     * @var string
     */
    public string $user;
    /**
     * @var string
     */
    public string $network;
    /**
     * @var string
     */
    public string $identity;

    /**
     * @param string $user
     * @param string $network
     * @param string $identity
     */
    public function __construct(string $user, string $network, string $identity)
    {
        $this->user = $user;
        $this->network = $network;
        $this->identity = $identity;
    }
}
