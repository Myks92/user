<?php

declare(strict_types=1);

namespace Myks92\User\Tests\Unit\Model\User\Entity\User\User;

use Myks92\User\Model\User\Entity\User\Event\UserNetworkAttached;
use Myks92\User\Model\User\Entity\User\Network;
use Myks92\User\Tests\Builder\User\UserBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Myks92\User\Model\User\Entity\User\User
 */
class AttachNetworkTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = (new UserBuilder())->active()->build();

        $user->attachNetwork($network = 'vk', $identity = '0000001');

        self::assertCount(1, $networks = $user->getNetworks());
        self::assertInstanceOf(Network::class, $first = reset($networks));
        self::assertEquals($identity, $first->getIdentity());
        self::assertEquals($network, $first->getNetwork());

        /** @var UserNetworkAttached $event */
        $event = $user->releaseEvents()[2];

        self::assertInstanceOf(UserNetworkAttached::class, $event);
        self::assertEquals($user->getId(), $event->getId());
        self::assertEquals($first->getNetwork(), $event->getNetwork());
        self::assertEquals($first->getIdentity(), $event->getIdentity());
    }

    public function testAlready(): void
    {
        $user = (new UserBuilder())->active()->build();

        $user->attachNetwork($network = 'vk', $identity = '0000001');

        $this->expectExceptionMessage('Network is already attached.');
        $user->attachNetwork($network = 'vk', $identity = '0000001');
    }
}