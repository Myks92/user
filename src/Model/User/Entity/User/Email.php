<?php

declare(strict_types=1);

namespace Myks92\User\Model\User\Entity\User;

use Webmozart\Assert\Assert;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class Email
{
    /**
     * @var string
     */
    private string $value;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        Assert::notEmpty($value);
        Assert::email($value, 'Incorrect email.');
        $this->value = mb_strtolower($value);
    }

    /**
     * @param Email $other
     *
     * @return bool
     */
    public function isEqual(self $other): bool
    {
        return $this->getValue() === $other->getValue();
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}