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
    private Id $id;
    /**
     * @var Name
     */
    private Name $name;

    /**
     * @param Id $id
     * @param Name $name
     */
    public function __construct(Id $id, Name $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }
}