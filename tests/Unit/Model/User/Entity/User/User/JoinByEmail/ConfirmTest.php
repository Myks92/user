<?php

declare(strict_types=1);

namespace Myks92\User\Tests\Unit\Model\User\Entity\User\User\JoinByEmail;

use DateTimeImmutable;
use Myks92\User\Model\User\Entity\User\Token;
use Myks92\User\Tests\Builder\User\UserBuilder;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class ConfirmTest extends TestCase
{
    public function testSuccess(): void
    {
        $token = $this->createToken();

        $user = (new UserBuilder())->withJoinConfirmToken($token)->build();

        $date = new DateTimeImmutable();
        $user->confirmJoin($token->getValue(), $date);

        self::assertFalse($user->isWait());
        self::assertTrue($user->isActive());

        self::assertNull($user->getJoinConfirmToken());
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
