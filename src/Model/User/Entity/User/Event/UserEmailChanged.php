<?php

declare(strict_types=1);


namespace Myks92\User\Model\User\Entity\User\Event;


use Myks92\User\Model\User\Entity\User\Email;
use Myks92\User\Model\User\Entity\User\Id;

/**
 * Event User Email Changed
 *
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class UserEmailChanged
{
    /**
     * @var Id
     */
    private Id $id;
    /**
     * @var Email
     */
    private Email $email;

    /**
     * @param Id $id
     * @param Email $email
     */
    public function __construct(Id $id, Email $email)
    {
        $this->id = $id;
        $this->email = $email;
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }
}