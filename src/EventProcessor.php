<?php

namespace SSDMTechTest;

use EventInterface;
use EventStorageInterface;

abstract class EventProcessor

{
    protected $event_types = [];
    protected $event_storage;

    /**
     * Inject EventStorageInterface in constructor
     * @param EventStorageInterface $event_storage
     */
    public function __construct(EventStorageInterface $event_storage)
    {
        $this->event_storage = $event_storage;
    }

    /**
     * Inject EventInterface
     * @param EventInterface $event
     * @return boolean
     */
     public function process(EventInterface $event)
    {
        $validEvent = $this->isValidEvent($event);
        if ($validEvent)
        {
            $this->event_storage->store($event);
            return true;
        }
        return false;
    }

    /**
     * Checks if the event is valid
     * @param EventInterface $event
     * @return boolean
     */
    public function isValidEvent(EventInterface $event)
    {
        $valid = in_array($event->getEventType(), $this->getEventTypes());

        return $valid;
    }


    /**
     * Returns all the event types
     */
    protected function getEventTypes()
    {
        return $this->event_types;
    }

}
