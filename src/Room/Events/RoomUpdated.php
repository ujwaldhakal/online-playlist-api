<?php

namespace OP\Room\Events;

class RoomUpdated
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
