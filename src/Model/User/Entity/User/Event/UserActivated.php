<?php

declare(strict_types=1);


namespace Myks92\User\Model\User\Entity\User\Event;


use Myks92\User\Model\User\Entity\User\Id;

/**
 * Event User Activated
 *
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class UserActivated
{
    /**
     * @var Id
     */
    public $id;
    /**
     * @var string
     */
    public $status;

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