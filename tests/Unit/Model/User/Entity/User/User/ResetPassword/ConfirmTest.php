<?php

declare(strict_types=1);

namespace Myks92\User\Tests\Unit\Model\User\Entity\User\User\ResetPassword;

use DateTimeImmutable;
use Myks92\User\Model\User\Entity\User\Event\UserPasswordResetted;
use Myks92\User\Model\User\Entity\User\Token;
use Myks92\User\Tests\Builder\User\UserBuilder;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

/**
 * @covers \Myks92\User\Model\User\Entity\User\User
 */
class ConfirmTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = (new UserBuilder())->active()->build();

        $now = new DateTimeImmutable();
        $token = $this->createToken($now->modify('+1 hour'));
        $user->requestPasswordReset($token, $now);

        self::assertNotNull($user->getPasswordResetToken());

        $user->confirmPasswordReset($token->getValue(), $now, $hash = 'hash');

        self::assertNull($user->getPasswordResetToken());
        self::assertEquals($hash, $user->getPasswordHash());

        /** @var UserPasswordResetted $event */
        $event = $user->releaseEvents()[3];

        self::assertInstanceOf(UserPasswordResetted::class, $event);
        self::assertEquals($user->getId(), $event->getId());
        self::assertEquals($now, $event->getDate());
    }

    public function testExpiredToken(): void
    {
        $user = (new UserBuilder())->active()->build();

        $now = new DateTimeImmutable();
        $token = $this->createToken($now->modify('+1 hour'));
        $user->requestPasswordReset($token, $now);

        $this->expectExceptionMessage('Token is expired.');
        $user->confirmPasswordReset($token->getValue(), $now->modify('+1 day'), 'hash');
    }

    public function testNotRequested(): void
    {
        $user = (new UserBuilder())->active()->build();

        $now = new DateTimeImmutable();

        $this->expectExceptionMessage('Resetting is not requested.');
        $user->confirmPasswordReset(Uuid::uuid4()->toString(), $now, 'hash');
    }

    private function createToken(DateTimeImmutable $date): Token
    {
        return new Token(
            Uuid::uuid4()->toString(), $date
        );
    }
}
