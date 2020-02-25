<?php

declare(strict_types=1);

namespace Myks92\User\Tests\Unit\Model\User\Entity\User\User;

use Myks92\User\Model\User\Entity\User\Event\UserActivated;
use Myks92\User\Tests\Builder\User\UserBuilder;
use PHPUnit\Framework\TestCase;

class ActivateTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = (new UserBuilder())->build();

        $user->activate();

        self::assertTrue($user->isActive());
        self::assertFalse($user->isBlocked());

        /** @var UserActivated $event */
        $event = $user->releaseEvents()[1];

        self::assertInstanceOf(UserActivated::class, $event);
        self::assertEquals($user->getId(), $event->getId());
        self::assertEquals($user->getStatus(), $event->getStatus());
    }

    public function testAlready(): void
    {
        $user = (new UserBuilder())->build();

        $user->activate();

        $this->expectExceptionMessage('User is already active.');
        $user->activate();
    }
}
