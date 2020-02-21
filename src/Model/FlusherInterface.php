<?php

declare(strict_types=1);

namespace Myks92\User\Model;


/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
interface FlusherInterface
{
    /**
     * @param AggregateRoot ...$roots
     */
    public function flush(AggregateRoot ...$roots): void;
}