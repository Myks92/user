<?php

declare(strict_types=1);


namespace Myks92\User\Tests\Unit\Model\User\Entity\User\User;


use Myks92\User\Model\User\Entity\User\Event\UserRemoved;
use Myks92\User\Tests\Builder\User\UserBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Myks92\User\Model\User\Entity\User\User
 */
class RemoveTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = (new UserBuilder())->build();

        $user->remove();

        /** @var UserRemoved $event */
        $event = $user->releaseEvents()[1];

        self::assertInstanceOf(UserRemoved::class, $event);
        self::assertEquals($user->getId(), $event->getId());
    }

    public function testActive(): void
    {
        $user = (new UserBuilder())->active()->build();

        $this->expectExceptionMessage('Unable to remove active user.');

        $user->remove();
    }
}