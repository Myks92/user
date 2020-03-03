<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\Command\JoinByNetwork;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class Command
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public string $network;
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public string $identity;
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public string $firstName;
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public string $lastName;
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    public string $email;

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
