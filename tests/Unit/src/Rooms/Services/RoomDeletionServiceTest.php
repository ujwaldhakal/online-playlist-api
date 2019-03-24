<?php

namespace tests\src\Rooms\Services;

use OP\Authentication\Entities\User;
use OP\Room\Entities\Room;
use OP\Room\Exceptions\CannotDeleteOthersRoom;
use OP\Room\Exceptions\RoomDoesNotExist;
use OP\Room\Exceptions\RoomWithGivenNameAlreadyExists;
use OP\Room\Services\RoomCreationService;
use OP\Room\Services\RoomDeletionService;

class RoomDeletionServiceTest extends \TestCase
{
    protected $room;
    protected $user;

    public function basicSetup()
    {
        $this->room = \Mockery::mock(Room::class);
        $this->user = \Mockery::mock(User::class);
    }


    public function testWhenProvidedInvalidId()
    {
        $this->basicSetup();
        $this->room->shouldReceive('findById')->andReturn(false);
        $this->expectException(RoomDoesNotExist::class);
        $roomDeletionService = new RoomDeletionService(['name' => 'a'], $this->user, $this->room);
    }



    public function testWhenProvidedSomeoneTriesToDeleteRoomThatTheyDontOwn()
    {
        $this->basicSetup();
        $this->room->shouldReceive('findById')->andReturn($this->room);
        $this->room->shouldReceive('getCreatorId')->andReturn(5);
        $this->user->shouldReceive('getId')->andReturn(1);
        $this->expectException(CannotDeleteOthersRoom::class);
        $roomDeletionService = new RoomDeletionService(['name' => 'a'], $this->user, $this->room);
    }

    public function testWhenProvidedAllValidData()
    {
        $this->basicSetup();
        $this->room->shouldReceive('findById')->andReturn($this->room);
        $this->room->shouldReceive('getCreatorId')->andReturn(5);
        $this->user->shouldReceive('getId')->andReturn(5);
        $roomDeletionService = new RoomDeletionService(['name' => 'a'], $this->user, $this->room);
    }



}
