<?php

namespace tests\Unit\src\Rooms\Events;

use Illuminate\Support\Facades\Event;
use OP\Authentication\Entities\User;
use OP\Room\Entities\Room;
use OP\Room\Events\RoomCreated;
use OP\Room\Listeners\CreateRoom;
use OP\Room\Services\RoomCreationService;

class RoomCreatedTest extends \TestCase
{
    public function testListenersWhenEventIsFired()
    {
        $createRoomListener = \Mockery::spy(CreateRoom::class);
        app()->instance(CreateRoom::class,$createRoomListener);
        $roomCreationService = \Mockery::mock(RoomCreationService::class);
        \event(new RoomCreated($roomCreationService));
        $createRoomListener->shouldHaveReceived('handle');
    }
}
