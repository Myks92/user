<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\Command\ChangeEmail\Request;

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
     * @var string
     * @Assert\NotBlank()
     * @Assert\ChangeEmail()
     */
    public string $email;

    /**
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }
}
