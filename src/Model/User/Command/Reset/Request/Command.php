<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\Command\Reset\Request;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class Command
{
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    public string $email;
}