<?php

namespace tests\Unit\src\Rooms\Events;

use Illuminate\Support\Facades\Event;
use OP\Authentication\Entities\User;
use OP\Room\Entities\Room;
use OP\Room\Events\RoomCreated;
use OP\Room\Events\RoomDeleted;
use OP\Room\Listeners\CreateRoom;
use OP\Room\Listeners\DeleteRoom;
use OP\Room\Services\RoomCreationService;
use OP\Room\Services\RoomDeletionService;

class RoomDeletedTest extends \TestCase
{
    public function testListenersWhenEventIsFired()
    {
        $deleteRoomListener = \Mockery::spy(DeleteRoom::class);
        app()->instance(DeleteRoom::class,$deleteRoomListener);
        $roomCreationService = \Mockery::mock(RoomDeletionService::class);
        \event(new RoomDeleted($roomCreationService));
        $deleteRoomListener->shouldHaveReceived('handle');
    }
}
