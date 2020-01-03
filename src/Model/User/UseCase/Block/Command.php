<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\UseCase\Block;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class Command
{
    /**
     * @Assert\NotBlank()
     */
    public $id;

    /**
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }
}
