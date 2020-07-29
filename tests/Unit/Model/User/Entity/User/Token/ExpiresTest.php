<?php

declare(strict_types=1);


namespace Myks92\User\Tests\Unit\Model\User\Entity\User\Token;


use DateTimeImmutable;
use Myks92\User\Model\User\Entity\User\Token;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

/**
 * @covers \Myks92\User\Model\User\Entity\User\Token::isExpiredTo
 */
class ExpiresTest extends TestCase
{
    public function testNot(): void
    {
        $token = new Token($value = Uuid::uuid4()->toString(), $expires = new DateTimeImmutable());

        self::assertFalse($token->isExpiredTo($expires->modify('-1 secs')));
        self::assertTrue($token->isExpiredTo($expires));
        self::assertTrue($token->isExpiredTo($expires->modify('+1 secs')));
    }
}