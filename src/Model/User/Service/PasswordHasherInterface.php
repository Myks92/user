<?php
declare(strict_types=1);

namespace Myks92\User\Model\User\Service;


/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
interface PasswordHasherInterface
{
    /**
     * @param string $password
     *
     * @return string
     */
    public function hash(string $password): string;

    /**
     * @param string $password
     * @param string $hash
     *
     * @return bool
     */
    public function validate(string $password, string $hash): bool;
}