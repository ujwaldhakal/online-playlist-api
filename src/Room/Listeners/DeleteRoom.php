<?php

namespace OP\Room\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use OP\Room\Entities\RoomInterface;
use OP\Room\Events\RoomCreated;
use OP\Room\Events\RoomDeleted;

class DeleteRoom
{
    private $room;

    public function __construct(RoomInterface $room)
    {
        $this->room = $room;
    }

    public function handle(RoomDeleted $event)
    {
        $this->room->remove($event->getService());
    }
}
