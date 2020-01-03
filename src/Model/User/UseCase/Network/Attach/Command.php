<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\UseCase\Network\Attach;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class Command
{
    /**
     * @var string
     */
    public $user;
    /**
     * @var string
     */
    public $network;
    /**
     * @var string
     */
    public $identity;

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
