<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\Service;


use Exception;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
interface NewEmailConfirmTokenizerInterface
{
    /**
     * @return string
     * @throws Exception
     */
    public function generate(): string;
}