<?php
interface EventStorageInterface
{
	/**
	 * Stores an event
	 * @param  EventInterface $event
	 * @return boolean
	 */
    public function store(EventInterface $event);

}