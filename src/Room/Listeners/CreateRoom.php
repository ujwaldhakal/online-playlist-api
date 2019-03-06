<?php

namespace OP\Room\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use OP\Room\Entities\RoomInterface;
use OP\Room\Events\RoomCreated;

class CreateRoom implements ShouldQueue
{
    private $room;

    public function __construct(RoomInterface $room)
    {
        $this->room = $room;
    }

    public function handle(RoomCreated $event)
    {
        $this->room->create($event->getService());
    }
}
