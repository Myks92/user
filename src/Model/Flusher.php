<?php

declare(strict_types=1);

namespace Myks92\User\Model;

use Doctrine\ORM\EntityManagerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
class Flusher implements FlusherInterface
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;
    /**
     * @var EventDispatcherInterface
     */
    private EventDispatcherInterface $dispatcher;

    /**
     * @param EntityManagerInterface $em
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(EntityManagerInterface $em, EventDispatcherInterface $dispatcher)
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
            foreach ($root->releaseEvents() as $event) {
                $this->dispatcher->dispatch($event);
            }
        }
    }
}
