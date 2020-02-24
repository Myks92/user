<?php

declare(strict_types=1);

namespace Myks92\User\Tests\Unit\Model\User\Entity\User\Email;

use DateTimeImmutable;
use Myks92\User\Model\User\Entity\User\Email;
use Myks92\User\Model\User\Entity\User\Token;
use Myks92\User\Tests\Builder\User\UserBuilder;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class RequestTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = (new UserBuilder())->withEmail($old = new Email('old-email@app.test'))->active()->build();

        $now = new DateTimeImmutable();
        $token = $this->createToken($now->modify('+1 day'));

        $user->requestEmailChanging($token, $now, $new = new Email('new-email@app.test'));

        self::assertEquals($token, $user->getNewEmailToken());
        self::assertEquals($old, $user->getEmail());
        self::assertEquals($new, $user->getNewEmail());
    }

    public function testSame(): void
    {
        $user = (new UserBuilder())->withEmail($old = new Email('old-email@app.test'))->active()->build();

        $now = new DateTimeImmutable();
        $token = $this->createToken($now->modify('+1 day'));

        $this->expectExceptionMessage('Email is already same.');
        $user->requestEmailChanging($token, $now, $old);
    }

    public function testAlready(): void
    {
        $user = (new UserBuilder())->active()->build();

        $now = new DateTimeImmutable();
        $token = $this->createToken($now->modify('+1 day'));

        $user->requestEmailChanging($token, $now, $email = new Email('new-email@app.test'));

        $this->expectExceptionMessage('Changing is already requested.');
        $user->requestEmailChanging($token, $now, $email);
    }

    public function testExpired(): void
    {
        $user = (new UserBuilder())->active()->build();

        $now = new DateTimeImmutable();
        $token = $this->createToken($now->modify('+1 hour'));
        $user->requestEmailChanging($token, $now, new Email('temp-email@app.test'));

        $newDate = $now->modify('+2 hours');
        $newToken = $this->createToken($newDate->modify('+1 hour'));
        $user->requestEmailChanging($newToken, $newDate, $newEmail = new Email('new-email@app.test'));

        self::assertEquals($newToken, $user->getNewEmailToken());
        self::assertEquals($newEmail, $user->getNewEmail());
    }

    public function testNotActive(): void
    {
        $now = new DateTimeImmutable();
        $token = $this->createToken($now->modify('+1 day'));

        $user = (new UserBuilder())->build();

        $this->expectExceptionMessage('User is not active.');
        $user->requestPasswordReset($token, $now);
    }

    private function createToken(DateTimeImmutable $date): Token
    {
        return new Token(
            Uuid::uuid4()->toString(), $date
        );
    }
}
