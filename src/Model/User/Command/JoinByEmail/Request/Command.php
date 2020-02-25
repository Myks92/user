<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\Command\JoinByEmail\Request;

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
    public string $firstName;
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public string $lastName;
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public string $email;
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min=6)
     */
    public string $password;
}
