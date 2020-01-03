<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\Service;

use Exception;
use Ramsey\Uuid\Uuid;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class NewEmailConfirmTokenizer implements NewEmailConfirmTokenizerInterface
{
    /**
     * @return string
     * @throws Exception
     */
    public function generate(): string
    {
        return Uuid::uuid4()->toString();
    }
}
