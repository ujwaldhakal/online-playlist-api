<?php

namespace OP\Room\Events;

use OP\Room\Services\RoomUpdateService;

class RoomUpdated
{
    private $service;

    public function __construct(RoomUpdateService $service)
    {
        $this->service = $service;
    }

    public function getService(): RoomUpdateService
    {
        return $this->service;
    }

}
