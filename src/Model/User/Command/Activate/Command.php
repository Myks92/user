<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\Command\Activate;

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
    public string $id;

    /**
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }
}
