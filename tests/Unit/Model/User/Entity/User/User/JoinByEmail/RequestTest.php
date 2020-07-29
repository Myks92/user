<?php

declare(strict_types=1);

namespace Myks92\User\Tests\Unit\Model\User\Entity\User\User\JoinByEmail;

use DateTimeImmutable;
use Myks92\User\Model\User\Entity\User\Email;
use Myks92\User\Model\User\Entity\User\Event\UserByEmailJoined;
use Myks92\User\Model\User\Entity\User\Id;
use Myks92\User\Model\User\Entity\User\Name;
use Myks92\User\Model\User\Entity\User\Role;
use Myks92\User\Model\User\Entity\User\Token;
use Myks92\User\Model\User\Entity\User\User;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

/**
 * @covers \Myks92\User\Model\User\Entity\User\User
 */
class RequestTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = User::requestJoinByEmail(
            $id = Id::generate(),
            $date = new DateTimeImmutable(),
            $name = new Name('First', 'Last'),
            $email = new Email('test@app.test'),
            $hash = 'hash',
            $token = new Token(Uuid::uuid4()->toString(), new DateTimeImmutable())
        );

        self::assertEquals($id, $user->getId());
        self::assertEquals($date, $user->getDate());
        self::assertEquals($name, $user->getName());
        self::assertEquals($email, $user->getEmail());
        self::assertEquals($hash, $user->getPasswordHash());
        self::assertEquals($token, $user->getJoinConfirmToken());

        self::assertTrue($user->isWait());
        self::assertFalse($user->isActive());

        self::assertEquals(Role::USER, $user->getRole()->getName());

        /** @var UserByEmailJoined $event */
        $event = $user->releaseEvents()[0];

        self::assertInstanceOf(UserByEmailJoined::class, $event);
        self::assertEquals($user->getId(), $event->getId());
        self::assertEquals($user->getName(), $event->getName());
        self::assertEquals($user->getEmail(), $event->getEmail());
        self::assertEquals($user->getJoinConfirmToken(), $event->getToken());
        self::assertEquals($user->getDate(), $event->getDate());
    }
}