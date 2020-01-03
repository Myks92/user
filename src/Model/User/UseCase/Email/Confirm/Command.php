<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\UseCase\Email\Confirm;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class Command
{
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $token;

    /**
     * @param string $id
     * @param string $token
     */
    public function __construct(string $id, string $token)
    {
        $this->id = $id;
        $this->token = $token;
    }
}
