<?php

declare(strict_types=1);


namespace Myks92\User\Tests\Unit\Model\User\Entity\User;


use InvalidArgumentException;
use Myks92\User\Model\User\Entity\User\Role;
use PHPUnit\Framework\TestCase;

class RoleTest extends TestCase
{
    public function testSuccess(): void
    {
        $role = new Role($name = Role::ADMIN);

        self::assertEquals($name, $role->getName());
    }

    public function testIncorrect(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Role('none');
    }

    public function testEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Role('');
    }

    public function testUserFactory(): void
    {
        $role = Role::user();

        self::assertEquals(Role::USER, $role->getName());
    }

    public function testAdminFactory(): void
    {
        $role = Role::admin();

        self::assertEquals(Role::ADMIN, $role->getName());
    }
}