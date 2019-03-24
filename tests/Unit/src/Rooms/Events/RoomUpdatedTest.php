<?php

namespace tests\Unit\src\Rooms\Events;

use Illuminate\Support\Facades\Event;
use OP\Authentication\Entities\User;
use OP\Room\Entities\Room;
use OP\Room\Events\RoomCreated;
use OP\Room\Events\RoomDeleted;
use OP\Room\Events\RoomUpdated;
use OP\Room\Listeners\CreateRoom;
use OP\Room\Listeners\DeleteRoom;
use OP\Room\Listeners\UpdateRoom;
use OP\Room\Services\RoomCreationService;
use OP\Room\Services\RoomDeletionService;
use OP\Room\Services\RoomUpdateService;

class RoomUpdatedTest extends \TestCase
{
    public function testListenersWhenEventIsFired()
    {
        $updateRoomListener = \Mockery::spy(UpdateRoom::class);
        app()->instance(UpdateRoom::class, $updateRoomListener);
        $roomUpdateService = \Mockery::mock(RoomUpdateService::class);
        \event(new RoomUpdated($roomUpdateService));
        $updateRoomListener->shouldHaveReceived('handle');
    }
}
