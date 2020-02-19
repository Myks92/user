<?php

declare(strict_types=1);


namespace Myks92\User\Model\User\Entity\User\Event;


use Myks92\User\Model\User\Entity\User\Id;
use Myks92\User\Model\User\Entity\User\Name;

/**
 * Event User Name Changed
 *
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class UserNameChanged
{
    /**
     * @var Id
     */
    public $id;
    /**
     * @var Name
     */
    public $name;

    /**
     * @param Id $id
     * @param Name $name
     */
    public function __construct(Id $id, Name $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}