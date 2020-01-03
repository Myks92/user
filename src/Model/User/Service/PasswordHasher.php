<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\Service;

use RuntimeException;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class PasswordHasher implements PasswordHasherInterface
{
    /**
     * @param string $password
     *
     * @return string
     */
    public function hash(string $password): string
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        if ($hash === false) {
            throw new RuntimeException('Unable to generate hash.', [], 'error');
        }
        return $hash;
    }

    /**
     * @param string $password
     * @param string $hash
     *
     * @return bool
     */
    public function validate(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}
