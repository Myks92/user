<?php

declare(strict_types=1);

namespace Myks92\User\Tests\Unit\Model\User\Entity\User\User;

use Myks92\User\Model\User\Entity\User\Event\UserRoleChanged;
use Myks92\User\Model\User\Entity\User\Role;
use Myks92\User\Tests\Builder\User\UserBuilder;
use PHPUnit\Framework\TestCase;

class ChangeRoleTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = (new UserBuilder())->build();

        $user->changeRole(Role::admin());

        self::assertFalse($user->getRole()->isUser());
        self::assertTrue($user->getRole()->isAdmin());

        /** @var UserRoleChanged $event */
        $event = $user->releaseEvents()[1];

        self::assertInstanceOf(UserRoleChanged::class, $event);
        self::assertEquals($user->getId(), $event->getId());
        self::assertEquals($user->getRole(), $event->getRole());
    }

    public function testAlready(): void
    {
        $user = (new UserBuilder())->build();

        $this->expectExceptionMessage('Role is already same.');

        $user->changeRole(Role::user());
    }
}
