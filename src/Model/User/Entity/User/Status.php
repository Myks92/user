<?php

declare(strict_types=1);


namespace Myks92\User\Model\User\Entity\User;


/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class Status
{
    private const WAIT = 'wait';
    private const ACTIVE = 'active';
    private const BLOCKED = 'blocked';

    /**
     * @var string
     */
    private string $name;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return static
     */
    public static function wait(): self
    {
        return new self(self::WAIT);
    }

    /**
     * @return static
     */
    public static function active(): self
    {
        return new self(self::ACTIVE);
    }

    /**
     * @return static
     */
    public static function blocked(): self
    {
        return new self(self::BLOCKED);
    }

    /**
     * @return bool
     */
    public function isWait(): bool
    {
        return $this->name === self::WAIT;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->name === self::ACTIVE;
    }

    /**
     * @return bool
     */
    public function isBlocked(): bool
    {
        return $this->name === self::BLOCKED;
    }
}