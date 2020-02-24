<?php

declare(strict_types=1);

namespace Myks92\User\Model;

/**
 * Trait EventsTrait
 *
 * @package Myks92\User\Model
 */
trait EventsTrait
{
    /**
     * @var array
     */
    private array $recordedEvents = [];

    /**
     * @return array
     */
    public function releaseEvents(): array
    {
        $events = $this->recordedEvents;
        $this->recordedEvents = [];
        return $events;
    }

    /**
     * @param object $event
     */
    protected function recordEvent(object $event): void
    {
        $this->recordedEvents[] = $event;
    }
}
