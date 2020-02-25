<?php

declare(strict_types=1);

namespace Myks92\User\Tests\Unit\Model\User\Entity\User\User\JoinByEmail;

use DateTimeImmutable;
use Myks92\User\Model\User\Entity\User\Event\UserRegisterConfirmed;
use Myks92\User\Model\User\Entity\User\Token;
use Myks92\User\Tests\Builder\User\UserBuilder;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class ConfirmTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = (new UserBuilder())->withJoinConfirmToken($token = $this->createToken())->build();

        self::assertTrue($user->isWait());
        self::assertFalse($user->isActive());

        $user->confirmJoin(
            $token->getValue(),
            $token->getExpires()->modify('-1 day')
        );

        self::assertFalse($user->isWait());
        self::assertTrue($user->isActive());

        self::assertNull($user->getJoinConfirmToken());

        /** @var UserRegisterConfirmed $event */
        $event = $user->releaseEvents()[1];

        self::assertInstanceOf(UserRegisterConfirmed::class, $event);
        self::assertEquals($user->getId(), $event->getId());
        self::assertEquals($user->getStatus(), $event->getStatus());
    }

    public function testWrong(): void
    {
        $user = (new UserBuilder())->withJoinConfirmToken($token = $this->createToken())->build();

        $this->expectExceptionMessage('Token is invalid.');

        $user->confirmJoin(
            Uuid::uuid4()->toString(),
            $token->getExpires()->modify('-1 day')
        );
    }

    public function testExpired(): void
    {
        $user = (new UserBuilder())->withJoinConfirmToken($token = $this->createToken())->build();

        $this->expectExceptionMessage('Token is expired.');

        $user->confirmJoin(
            $token->getValue(),
            $token->getExpires()->modify('+1 day')
        );
    }

    public function testAlready(): void
    {
        $token = $this->createToken();

        $user = (new UserBuilder())->withJoinConfirmToken($token)->active()->build();

        $this->expectExceptionMessage('Confirmation is not required.');

        $user->confirmJoin(
            $token->getValue(),
            $token->getExpires()->modify('-1 day')
        );
    }

    private function createToken(): Token
    {
        return new Token(
            Uuid::uuid4()->toString(), new DateTimeImmutable('+1 day')
        );
    }
}
