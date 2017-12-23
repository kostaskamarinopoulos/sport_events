<?php

namespace Tests;

use SSDMTechTest\FootballEventProcessor;
use \PHPUnit\Framework\TestCase;

class FootballEventTest extends TestCase
{
    protected $event_storage;
    protected $event_types = [
        'kickoff',
        'goal',
        'yellowcard',
        'redcard',
        'penalty',
        'halftime',
        'fulltime',
        'extratime',
        'freekick',
        'corner',
    ];


    public function setUp()
    {
        $this->event_storage = $this->getMockBuilder('EventStorageInterface')->getMock();
    }


    /**
     * Test valid events
     *@test
     */
    public function isValidEvent()
    {
        $footballEventProcessor = new FootballEventProcessor($this->event_storage);
        foreach ($this->event_types as $event_type) {
            $event = $this->getMockBuilder('EventInterface')->setMethods(['getEventType'])->getMock();
            $event->expects($this->once())
                ->method('getEventType')
                ->will($this->returnValue($event_type));

            $this->assertTrue($footballEventProcessor->isValidEvent($event));
        }
    }

    /**
     * Test not valid events
     *@test
     */
    public function isNotValidEvent()
    {
        $event_type = 'not_valid_event';
        $footballEventProcess = new FootballEventProcessor($this->event_storage);
        $event = $this->getMockBuilder('EventInterface')->setMethods(['getEventType'])->getMock();
            $event->expects($this->once())
            ->method('getEventType')
            ->will($this->returnValue($event_type));

        $this->assertFalse($footballEventProcess->isValidEvent($event));
    }

    /**
     * Test if process is valid
     *@test
     */
    public function isValidProcess()
    {
        foreach ($this->event_types as $event_type)
        {
            $event = $this->getMockBuilder('EventInterface')->setMethods(['getEventType'])->getMock();
            $event->expects($this->once())
                ->method('getEventType')
                ->will($this->returnValue($event_type));

            $store = $this->getMockBuilder('EventStorageInterface')->setMethods(['store'])->getMock();
            $store->expects($this->once())
                ->method('store')
                ->will($this->returnValue($event_type));

            $footballEventProcessor = new FootballEventProcessor($store);

            $this->assertTrue($footballEventProcessor->process($event));
        }
    }
}
