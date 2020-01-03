<?php

declare(strict_types=1);

namespace Myks92\User\Model;

use Doctrine\ORM\EntityManagerInterface;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class Flusher
{
    private $em;
    private $dispatcher;

    /**
     * @param EntityManagerInterface $em
     * @param EventDispatcher $dispatcher
     */
    public function __construct(EntityManagerInterface $em, EventDispatcher $dispatcher)
    {
        $this->em = $em;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param AggregateRoot ...$roots
     */
    public function flush(AggregateRoot ...$roots): void
    {
        $this->em->flush();

        foreach ($roots as $root) {
            $this->dispatcher->dispatch($root->releaseEvents());
        }
    }
}
