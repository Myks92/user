<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\UseCase\SignUp\Confirm\ByToken;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class Command
{
    /**
     * @var string
     */
    public $token;

    /**
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }
}
