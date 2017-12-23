<?php

namespace SSDMTechTest;

class FootballEventProcessor extends EventProcessor
{
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
}
