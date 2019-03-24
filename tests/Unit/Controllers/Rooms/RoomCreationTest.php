<?php

namespace tests\Unit\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use OP\Authentication\Entities\User;
use OP\Room\Entities\Room;
use OP\Room\Events\RoomCreated;
use OP\Services\Response\ApiResponse;

class RoomCreationTest extends \TestCase
{

    public function testWhenAllDataAreValid()
    {
        $roomCreationController = new \App\Http\Controllers\Room\Create();


        $request = \Mockery::mock(Request::class)->shouldAllowMockingProtectedMethods();
        $user = \Mockery::mock(User::class);
        $room = \Mockery::mock(Room::class);
        $application = app();
        $apiResponse = new ApiResponse();

        $request->shouldReceive('all')->andReturn(['name' => 'music-collection']);
        $request->shouldReceive('get')->with('name')->andReturn('music-collection');
        $request->shouldReceive('only')->andReturn(['name' => 'music-collection']);
        $user->shouldReceive('getId')->andReturn(1);
        $room->shouldReceive('findBySlug')->andReturn(false);


        $this->expectsEvents([RoomCreated::class]);

        $response = json_decode($roomCreationController($application,$request, $apiResponse,$user,$room),true);
        $this->assertArrayHasKey('data', $response);
        $this->assertArrayHasKey('id', $response['data']);
        $this->assertArrayHasKey('name', $response['data']);
        $this->assertArrayHasKey('creator_id', $response['data']);
        $this->assertArrayHasKey('slug', $response['data']);
        $this->assertArrayHasKey('description', $response['data']);
        $this->assertArrayHasKey('dj_id', $response['data']);
    }

    public function testWhenAllDataAreNotValid()
    {
        $roomCreationController = new \App\Http\Controllers\Room\Create();


        $request = \Mockery::mock(Request::class)->shouldAllowMockingProtectedMethods();
        $user = \Mockery::mock(User::class);
        $room = \Mockery::mock(Room::class);
        $application = app();
        $apiResponse = new ApiResponse();

        $request->shouldReceive('all')->andReturn(['name1' => 'music-collection']);
        $request->shouldReceive('get')->with('name1')->andReturn('music-collection');
        $request->shouldReceive('only')->andReturn(['name1' => 'music-collection']);
        $user->shouldReceive('getId')->andReturn(1);


        $this->withoutEvents();
        $this->expectException(ValidationException::class);
        $roomCreationController($application,$request, $apiResponse,$user,$room);
    }

}
