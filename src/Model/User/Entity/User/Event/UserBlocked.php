<?php

declare(strict_types=1);


namespace Myks92\User\Model\User\Entity\User\Event;


use Myks92\User\Model\User\Entity\User\Id;
use Myks92\User\Model\User\Entity\User\Status;

/**
 * Event User Blocked
 *
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class UserBlocked
{
    /**
     * @var Id
     */
    public Id $id;
    /**
     * @var Status
     */
    public Status $status;

    /**
     * @param Id $id
     * @param Status $status
     */
    public function __construct(Id $id, Status $status)
    {
        $this->id = $id;
        $this->status = $status;
    }
}