<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\Entity\User;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class StatusType extends StringType
{
    public const NAME = 'user_user_status';

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     *
     * @return mixed|string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof Status ? $value->getName() : $value;
    }

    /**
     * @param string $name
     * @param AbstractPlatform $platform
     *
     * @return Role|mixed|null
     */
    public function convertToPHPValue($name, AbstractPlatform $platform)
    {
        return !empty($name) ? new Status($name) : null;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * @param AbstractPlatform $platform
     *
     * @return bool
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
