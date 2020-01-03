<?php

declare(strict_types=1);

namespace Myks92\User\Model;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
interface EventDispatcher
{
    /**
     * @param array $events
     */
    public function dispatch(array $events): void;
}
