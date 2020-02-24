<?php

declare(strict_types=1);


namespace Myks92\User\Tests\Unit\Model\User\Service;


use DateInterval;
use DateTimeImmutable;
use Myks92\User\Model\User\Service\Tokenizer;
use PHPUnit\Framework\TestCase;

class TokenizerTest extends TestCase
{
    public function testSuccess(): void
    {
        $interval = new DateInterval('PT1H');
        $date = new DateTimeImmutable('+1 day');

        $tokenizer = new Tokenizer($interval);

        $token = $tokenizer->generate($date);

        self::assertEquals($date->add($interval), $token->getExpires());
    }
}