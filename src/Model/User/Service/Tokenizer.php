<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\Service;

use DateInterval;
use DateTimeImmutable;
use Exception;
use Myks92\User\Model\User\Entity\User\Token;
use Ramsey\Uuid\Uuid;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class Tokenizer implements TokenizerInterface
{
    /**
     * @var DateInterval
     */
    private DateInterval $interval;

    /**
     * @param DateInterval $interval
     */
    public function __construct(DateInterval $interval)
    {
        $this->interval = $interval;
    }

    /**
     * @param DateTimeImmutable $date
     *
     * @return Token
     * @throws Exception
     */
    public function generate(DateTimeImmutable $date): Token
    {
        return new Token(
            Uuid::uuid4()->toString(), $date->add($this->interval)
        );
    }
}