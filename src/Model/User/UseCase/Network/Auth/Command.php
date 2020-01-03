<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\UseCase\Network\Auth;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class Command
{
    /**
     * @var string
     */
    public $network;
    /**
     * @var string
     */
    public $identity;
    /**
     * @var string
     */
    public $firstName;
    /**
     * @var string
     */
    public $lastName;

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
