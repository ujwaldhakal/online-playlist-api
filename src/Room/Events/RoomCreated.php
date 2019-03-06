<?php

namespace OP\Room\Events;

use OP\Room\Services\RoomCreationService;

class RoomCreated
{
    private $service;

    public function __construct(RoomCreationService $service)
    {
        $this->service = $service;
    }

    public function getService(): RoomCreationService
    {
        return $this->service;
    }
}
