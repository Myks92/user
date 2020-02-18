<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\Service;

use DateInterval;
use DateTimeImmutable;
use Exception;
use Myks92\User\Model\User\Entity\User\ResetToken;
use Ramsey\Uuid\Uuid;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class ResetTokenizer
{
    private $interval;

    /**
     * @param DateInterval $interval
     */
    public function __construct(DateInterval $interval)
    {
        $this->interval = $interval;
    }

    /**
     * @return ResetToken
     * @throws Exception
     */
    public function generate(): ResetToken
    {
        return new ResetToken(Uuid::uuid4()->toString(), (new DateTimeImmutable())->add($this->interval));
    }
}