<?php

declare(strict_types=1);

namespace Myks92\User\Tests\Unit\Model\User\Entity\User\User;

use DateTimeImmutable;
use Myks92\User\Model\User\Entity\User\Email;
use Myks92\User\Model\User\Entity\User\Event\UserCreated;
use Myks92\User\Model\User\Entity\User\Id;
use Myks92\User\Model\User\Entity\User\Name;
use Myks92\User\Model\User\Entity\User\User;
use PHPUnit\Framework\TestCase;

class CreateTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = User::create(
            $id = Id::generate(),
            $date = new DateTimeImmutable(),
            $name = new Name('Fist', 'Last'),
            $email = new Email('created-email@app.test'),
            'hash'
        );

        self::assertEquals($id, $user->getId());
        self::assertEquals($date, $user->getDate());
        self::assertEquals($name, $user->getName());
        self::assertEquals($email, $user->getEmail());

        /** @var UserCreated $event */
        $event = $user->releaseEvents()[0];

        self::assertInstanceOf(UserCreated::class, $event);
        self::assertEquals($user->getId(), $event->getId());
        self::assertEquals($user->getDate(), $event->getDate());
        self::assertEquals($user->getName(), $event->getName());
        self::assertEquals($user->getEmail(), $event->getEmail());
    }
}