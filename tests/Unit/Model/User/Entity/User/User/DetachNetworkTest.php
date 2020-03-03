<?php

declare(strict_types=1);

namespace Myks92\User\Tests\Unit\Model\User\Entity\User\User;

use Myks92\User\Model\User\Entity\User\Event\UserNetworkDetached;
use Myks92\User\Model\User\Entity\User\Network;
use Myks92\User\Tests\Builder\User\UserBuilder;
use PHPUnit\Framework\TestCase;

class DetachNetworkTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = (new UserBuilder())->viaNetwork($networkVk = 'vk', $identityVk = '0000001')->active()->build();

        $user->attachNetwork($networkFacebook = 'facebook', $identityFacebook = '0000002');

        self::assertCount(2, $networks = $user->getNetworks());

        $user->detachNetwork($networkFacebook, $identityFacebook);

        self::assertCount(1, $networks = $user->getNetworks());
        self::assertInstanceOf(Network::class, $first = reset($networks));
        self::assertEquals($networkVk, $first->getNetwork());
        self::assertEquals($identityVk, $first->getIdentity());

        /** @var UserNetworkDetached $event */
        $event = $user->releaseEvents()[3];

        self::assertInstanceOf(UserNetworkDetached::class, $event);
        self::assertEquals($user->getId(), $event->getId());
        self::assertEquals($networkFacebook, $event->getNetwork());
        self::assertEquals($identityFacebook, $event->getIdentity());
    }

    public function testLast(): void
    {
        $user = (new UserBuilder())->viaNetwork($network = 'vk', $identity = '0000001')->active()->build();

        $this->expectExceptionMessage('Unable to detach the last identity.');
        $user->detachNetwork($network, $identity);
    }

    public function testNotAttached(): void
    {
        $user = (new UserBuilder())->active()->build();

        $this->expectExceptionMessage('Network is not attached.');
        $user->detachNetwork('vk', '0000001');
    }
}