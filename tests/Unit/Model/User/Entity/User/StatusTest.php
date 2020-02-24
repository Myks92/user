<?php

declare(strict_types=1);


namespace Myks92\User\Tests\Unit\Model\User\Entity\User;


use Myks92\User\Model\User\Entity\User\Status;
use PHPUnit\Framework\TestCase;

class StatusTest extends TestCase
{
    public function testWait(): void
    {
        $status = Status::wait();

        self::assertTrue($status->isWait());
        self::assertFalse($status->isActive());
        self::assertFalse($status->isBlocked());
    }

    public function testActive(): void
    {
        $status = Status::active();

        self::assertFalse($status->isWait());
        self::assertTrue($status->isActive());
        self::assertFalse($status->isBlocked());
    }

    public function testBlock(): void
    {
        $status = Status::blocked();

        self::assertFalse($status->isWait());
        self::assertFalse($status->isActive());
        self::assertTrue($status->isBlocked());
    }
}