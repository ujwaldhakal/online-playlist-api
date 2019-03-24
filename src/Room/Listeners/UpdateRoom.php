<?php

namespace OP\Room\Listeners;

use OP\Room\Entities\RoomInterface;
use OP\Room\Events\RoomCreated;
use OP\Room\Events\RoomUpdated;

class UpdateRoom
{
    private $room;

    public function __construct(RoomInterface $room)
    {
        $this->room = $room;
    }

    public function handle(RoomUpdated $event)
    {
        $this->room->updateData($event->getService());
    }
}
