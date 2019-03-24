<?php

namespace tests\Unit\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use OP\Authentication\Entities\User;
use OP\Room\Entities\Room;
use OP\Room\Events\RoomCreated;
use OP\Room\Events\RoomUpdated;
use OP\Room\Exceptions\RoomDoesNotBelongToYou;
use OP\Services\Response\ApiResponse;

class UpdateTest extends \TestCase
{

    public function testWhenAllDataAreValid()
    {
        $roomCreationController = new \App\Http\Controllers\Room\Update();


        $request = \Mockery::mock(Request::class);
        $request->id = 1;
        $user = \Mockery::mock(User::class);
        $room = \Mockery::mock(Room::class);
        $application = app();
        $apiResponse = new ApiResponse();

        $request->shouldReceive('all')->andReturn(['name' => 'music-collection']);
        $request->shouldReceive('only')->andReturn(['name' => 'music-collection']);
        $user->shouldReceive('getId')->andReturn(1);
        $room->shouldReceive('findById')->andReturn($room);
        $room->shouldReceive('getCreatorId')->andReturn(1);


        $this->expectsEvents([RoomUpdated::class]);

        $response = $roomCreationController($application, $request, $apiResponse, $user, $room);
        $this->assertSame(200, $response->getStatusCode());
    }

    public function testWhenImposterIsMakingRequest()
    {
        $roomCreationController = new \App\Http\Controllers\Room\Update();
        $request = \Mockery::mock(Request::class)->shouldAllowMockingProtectedMethods();
        $request->id = 1;
        $user = \Mockery::mock(User::class);
        $room = \Mockery::mock(Room::class);
        $application = app();
        $apiResponse = new ApiResponse();

        $request->shouldReceive('all')->andReturn(['name' => 'music-collection']);
        $request->shouldReceive('get')->with('name')->andReturn('music-collection');
        $request->shouldReceive('only')->andReturn(['name' => 'music-collection']);
        $user->shouldReceive('getId')->andReturn(1);
        $room->shouldReceive('findById')->andReturn($room);
        $room->shouldReceive('getCreatorId')->andReturn(2); // case when someone imposter trying to make changes


        $this->withoutEvents();
        $response = $roomCreationController($application, $request, $apiResponse, $user, $room);
        $this->assertSame(400, $response->getStatusCode());
        $this->assertSame('Room does not belong to you', $response->getMessage());
    }

    public function testWhenInvalidIdIsProvidedForUpdate()
    {
        $roomCreationController = new \App\Http\Controllers\Room\Update();
        $request = \Mockery::mock(Request::class)->shouldAllowMockingProtectedMethods();
        $request->id = 1;
        $user = \Mockery::mock(User::class);
        $room = \Mockery::mock(Room::class);
        $application = app();
        $apiResponse = new ApiResponse();

        $request->shouldReceive('all')->andReturn(['name' => 'music-collection']);
        $request->shouldReceive('get')->with('name')->andReturn('music-collection');
        $request->shouldReceive('only')->andReturn(['name' => 'music-collection']);
        $user->shouldReceive('getId')->andReturn(1);
        $room->shouldReceive('findById')->andReturn(false);
        $room->shouldReceive('getCreatorId')->andReturn(1); // case when someone imposter trying to make changes


        $this->withoutEvents();
        $response = $roomCreationController($application, $request, $apiResponse, $user, $room);
        $this->assertSame(400, $response->getStatusCode());
        $this->assertSame('Room does not exist', $response->getMessage());
    }

}
