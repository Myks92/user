<?php

declare(strict_types=1);


namespace Myks92\User\Model\User\Entity\User\Event;


use Myks92\User\Model\User\Entity\User\Id;
use Myks92\User\Model\User\Entity\User\Role;

/**
 * Event User Role Changed
 *
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class UserRoleChanged
{
    /**
     * @var Id
     */
    public $id;
    /**
     * @var Role
     */
    public $role;

    /**
     * @param Id $id
     * @param Role $role
     */
    public function __construct(Id $id, Role $role)
    {
        $this->id = $id;
        $this->role = $role;
    }
}