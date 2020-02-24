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
    public Id $id;
    /**
     * @var Email
     */
    public Email $email;

    /**
     * @param Id $id
     * @param Email $email
     */
    public function __construct(Id $id, Email $email)
    {
        $this->id = $id;
        $this->email = $email;
    }
}