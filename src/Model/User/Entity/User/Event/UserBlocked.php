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
    private Id $id;
    /**
     * @var Status
     */
    private Status $status;

    /**
     * @param Id $id
     * @param Status $status
     */
    public function __construct(Id $id, Status $status)
    {
        $this->id = $id;
        $this->status = $status;
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }
}