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

        self::assertEquals($id, $event->getId());
        self::assertEquals($date, $event->getDate());
        self::assertEquals($name, $event->getName());
        self::assertEquals($email, $event->getEmail());
    }
}