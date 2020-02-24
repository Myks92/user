<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\UseCase\Reset\Reset;

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
    public string $token;
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min=6)
     */
    public string $password;

    /**
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }
}