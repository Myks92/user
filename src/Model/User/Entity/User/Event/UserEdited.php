<?php

declare(strict_types=1);


namespace Myks92\User\Model\User\Entity\User\Event;


use Myks92\User\Model\User\Entity\User\Email;
use Myks92\User\Model\User\Entity\User\Id;
use Myks92\User\Model\User\Entity\User\Name;

/**
 * Event User Edited
 *
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class UserEdited
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
     * @var Email
     */
    public $email;

    /**
     * @param Id $id
     * @param Name $name
     * @param Email $email
     */
    public function __construct(Id $id, Name $name, Email $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }
}