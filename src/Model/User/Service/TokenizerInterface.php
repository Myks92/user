<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\Service;


use DateTimeImmutable;
use Myks92\User\Model\User\Entity\User\Token;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
interface TokenizerInterface
{
    /**
     * @param DateTimeImmutable $date
     *
     * @return Token
     */
    public function generate(DateTimeImmutable $date): Token;
}