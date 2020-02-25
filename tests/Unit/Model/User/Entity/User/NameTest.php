<?php

declare(strict_types=1);


namespace Myks92\User\Tests\Unit\Model\User\Entity\User;


use InvalidArgumentException;
use Myks92\User\Model\User\Entity\User\Name;
use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{
    public function testSuccess(): void
    {
        $name = new Name($first = 'First', $last = 'Last');

        self::assertEquals($first, $name->getFirst());
        self::assertEquals($last, $name->getLast());
        self::assertEquals($first . ' ' . $last, $name->getFull());
    }

    public function testEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Name($first = '', $last = '');
    }
}