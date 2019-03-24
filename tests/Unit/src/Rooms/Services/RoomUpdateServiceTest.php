<?php

namespace tests\src\Rooms\Services;

use OP\Authentication\Entities\User;
use OP\Room\Entities\Room;
use OP\Room\Exceptions\CannotDeleteOthersRoom;
use OP\Room\Exceptions\RoomDoesNotBelongToYou;
use OP\Room\Exceptions\RoomDoesNotExist;
use OP\Room\Exceptions\RoomWithGivenNameAlreadyExists;
use OP\Room\Services\RoomCreationService;
use OP\Room\Services\RoomDeletionService;
use OP\Room\Services\RoomUpdateService;

class RoomUpdateServiceTest extends \TestCase
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
        $roomDeletionService = new RoomUpdateService(1,['name' => 'a'], $this->user, $this->room);
    }


    public function testWhenProvidedSomeoneTriesToUpdateOthersRoom()
    {
        $this->basicSetup();
        $this->room->shouldReceive('findById')->andReturn($this->room);
        $this->room->shouldReceive('getCreatorId')->andReturn(5);
        $this->user->shouldReceive('getId')->andReturn(1);
        $this->expectException(RoomDoesNotBelongToYou::class);
        $roomDeletionService = new RoomUpdateService(1,['name' => 'a'], $this->user, $this->room);
    }

    public function testWhenProvidedAllValidData()
    {
        $this->basicSetup();
        $this->room->shouldReceive('findById')->andReturn($this->room);
        $this->room->shouldReceive('getCreatorId')->andReturn(5);
        $this->user->shouldReceive('getId')->andReturn(5);
        $roomDeletionService = new RoomUpdateService(1,['name' => 'a'], $this->user, $this->room);
    }


}
