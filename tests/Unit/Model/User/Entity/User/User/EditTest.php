<?php

declare(strict_types=1);

namespace Myks92\User\Tests\Unit\Model\User\Entity\User\User;

use Myks92\User\Model\User\Entity\User\Email;
use Myks92\User\Model\User\Entity\User\Event\UserEdited;
use Myks92\User\Model\User\Entity\User\Name;
use Myks92\User\Tests\Builder\User\UserBuilder;
use PHPUnit\Framework\TestCase;

class EditTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = (new UserBuilder())->build();

        $user->edit(
            $email = new Email('edit-email@app.test'),
            $name = new Name('Edit Fist', 'Edit Last')
        );

        self::assertEquals($email, $user->getEmail());
        self::assertEquals($name, $user->getName());

        /** @var UserEdited $event */
        $event = $user->releaseEvents()[1];

        self::assertEquals($user->getId(), $event->getId());
        self::assertEquals($name, $event->getName());
        self::assertEquals($email, $event->getEmail());
    }
}