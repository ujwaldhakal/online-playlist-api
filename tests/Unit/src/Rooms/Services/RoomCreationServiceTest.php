<?php

namespace tests\src\Rooms\Services;

use OP\Authentication\Entities\User;
use OP\Room\Entities\Room;
use OP\Room\Exceptions\RoomWithGivenNameAlreadyExists;
use OP\Room\Services\RoomCreationService;

class RoomCreationServiceTest extends \TestCase
{
    protected $room;
    protected $user;

    public function basicSetup()
    {
        $this->room = \Mockery::mock(Room::class);
        $this->user = \Mockery::mock(User::class);
    }


    public function testExceptionWhenDataAreInvalid()
    {
        $this->basicSetup();
        $this->room->shouldReceive('findBySlug')->andReturn(collect(['somedata' => 'somedata']));
        $this->expectException(RoomWithGivenNameAlreadyExists::class);
        $roomCreationService = new RoomCreationService(['name' => 'a'], $this->user, $this->room);
    }


    public function testExceptionWhenDataAreValid()
    {
        $this->basicSetup();
        $this->room->shouldReceive('findBySlug')->andReturn(false);
        $this->user->shouldReceive('getId')->andReturn(1);
        $roomCreationService = new RoomCreationService(['name' => 'a'], $this->user, $this->room);
        $this->assertArrayHasKey('id',$roomCreationService->extract());
        $this->assertArrayHasKey('name',$roomCreationService->extract());
        $this->assertArrayHasKey('creator_id',$roomCreationService->extract());
        $this->assertArrayHasKey('slug',$roomCreationService->extract());
    }

}
