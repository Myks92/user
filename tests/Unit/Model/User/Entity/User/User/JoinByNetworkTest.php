<?php

declare(strict_types=1);

namespace Myks92\User\Tests\Unit\Model\User\Entity\User\User;

use DateTimeImmutable;
use Myks92\User\Model\User\Entity\User\Email;
use Myks92\User\Model\User\Entity\User\Event\UserByNetworkJoined;
use Myks92\User\Model\User\Entity\User\Id;
use Myks92\User\Model\User\Entity\User\Name;
use Myks92\User\Model\User\Entity\User\Network;
use Myks92\User\Model\User\Entity\User\User;
use PHPUnit\Framework\TestCase;

class JoinByNetworkTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = User::joinByNetwork(
            $id = Id::generate(),
            $date = new DateTimeImmutable(),
            $name = new Name('First', 'Last'),
            $email = new Email('test@app.test'),
            $network = 'vk',
            $identity = '0000001'
        );

        self::assertTrue($user->isActive());

        self::assertEquals($id, $user->getId());
        self::assertEquals($date, $user->getDate());
        self::assertEquals($name, $user->getName());
        self::assertEquals($email, $user->getEmail());

        self::assertCount(1, $networks = $user->getNetworks());
        self::assertInstanceOf(Network::class, $first = reset($networks));
        self::assertEquals($network, $first->getNetwork());
        self::assertEquals($identity, $first->getIdentity());

        /** @var UserByNetworkJoined $event */
        $event = $user->releaseEvents()[1];

        self::assertInstanceOf(UserByNetworkJoined::class, $event);
        self::assertEquals($user->getId(), $event->getId());
        self::assertEquals($user->getName(), $event->getName());
        self::assertEquals($user->getDate(), $event->getDate());
        self::assertEquals($user->getEmail(), $event->getEmail());
        self::assertEquals($first->getIdentity(), $event->getIdentity());
        self::assertEquals($first->getNetwork(), $event->getNetwork());
    }
}