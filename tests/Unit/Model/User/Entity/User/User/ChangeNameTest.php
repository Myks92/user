<?php

declare(strict_types=1);

namespace Myks92\User\Tests\Unit\Model\User\Entity\User\User;

use Myks92\User\Model\User\Entity\User\Event\UserNameChanged;
use Myks92\User\Model\User\Entity\User\Name;
use Myks92\User\Tests\Builder\User\UserBuilder;
use PHPUnit\Framework\TestCase;

class ChangeNameTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = (new UserBuilder())->build();

        $user->changeName($name = new Name('Edit Name Fist', 'Edit Name Last'));

        self::assertEquals($name, $user->getName());

        /** @var UserNameChanged $event */
        $event = $user->releaseEvents()[1];

        self::assertInstanceOf(UserNameChanged::class, $event);
        self::assertEquals($user->getId(), $event->getId());
        self::assertEquals($user->getName(), $event->getName());
    }
}