<?php
declare(strict_types=1);


namespace Myks92\User\Tests\Unit\Model\User\Service;


use Myks92\User\Model\User\Service\PasswordHasher;
use PHPUnit\Framework\TestCase;

class PasswordHasherTest extends TestCase
{
    public function testSuccess(): void
    {
        $hasher = new PasswordHasher();
        $hash = $hasher->hash($password = 'password');

        self::assertTrue($hasher->validate($password, $hash));
    }

    public function testIncorrect(): void
    {
        $hasher = new PasswordHasher();
        $hash = $hasher->hash($password = 'password');

        self::assertFalse($hasher->validate('no-correct', $hash));
    }
}