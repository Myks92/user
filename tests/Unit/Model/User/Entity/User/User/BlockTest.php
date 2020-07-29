<?php

declare(strict_types=1);

namespace Myks92\User\Tests\Unit\Model\User\Entity\User\User;

use Myks92\User\Model\User\Entity\User\Event\UserBlocked;
use Myks92\User\Tests\Builder\User\UserBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Myks92\User\Model\User\Entity\User\User
 */
class BlockTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = (new UserBuilder())->build();

        $user->block();

        self::assertFalse($user->isActive());
        self::assertTrue($user->isBlocked());

        /** @var UserBlocked $event */
        $event = $user->releaseEvents()[1];

        self::assertInstanceOf(UserBlocked::class, $event);
        self::assertEquals($user->getId(), $event->getId());
        self::assertEquals($user->getStatus(), $event->getStatus());
    }

    public function testAlready(): void
    {
        $user = (new UserBuilder())->build();

        $user->block();

        $this->expectExceptionMessage('User is already blocked.');
        $user->block();
    }
}
