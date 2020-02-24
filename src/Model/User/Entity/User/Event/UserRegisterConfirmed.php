<?php

declare(strict_types=1);


namespace Myks92\User\Model\User\Entity\User\Event;


use Myks92\User\Model\User\Entity\User\Id;

/**
 * Event User Register Confirmed
 *
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class UserRegisterConfirmed
{
    /**
     * @var Id
     */
    public Id $id;
    /**
     * @var string
     */
    public string $status;

    /**
     * @param Id $id
     * @param string $status
     */
    public function __construct(Id $id, string $status)
    {
        $this->id = $id;
        $this->status = $status;
    }
}