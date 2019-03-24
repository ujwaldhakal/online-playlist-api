<?php

namespace tests\Unit\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use OP\Authentication\Entities\User;
use OP\Room\Entities\Room;
use OP\Room\Events\RoomCreated;
use OP\Room\Events\RoomDeleted;
use OP\Services\Response\ApiResponse;

class DeleteTest extends \TestCase
{

    public function testDeleteWhenAllDataAreNotValid()
    {
        $roomDeletionController = new \App\Http\Controllers\Room\Delete();


        $request = \Mockery::mock(Request::class)->shouldAllowMockingProtectedMethods();
        $request->id = 1;
        $user = \Mockery::mock(User::class)->makePartial();
        $room = \Mockery::mock(Room::class)->makePartial();
        $application = app();
        $apiResponse = new ApiResponse();
        $this->withoutEvents();

        $user->shouldReceive('getId')->andReturn(1);
        $room->shouldReceive('findById')->andReturn(false);



        $response = $roomDeletionController($application,$request, $apiResponse,$user,$room);


        $this->assertSame(400, $response->getStatusCode());
    }

    public function testDeleteWhenAllDataAreValid()
    {
        $roomDeletionController = new \App\Http\Controllers\Room\Delete();


        $request = \Mockery::mock(Request::class)->shouldAllowMockingProtectedMethods();
        $request->id = 1;
        $user = \Mockery::mock(User::class)->makePartial();
        $room = \Mockery::mock(Room::class)->makePartial();
        $application = app();
        $apiResponse = new ApiResponse();

        $user->shouldReceive('getId')->andReturn((int) 1);
        $room->shouldReceive('getCreatorId')->andReturn((int) 1);
        $room->shouldReceive('findById')->andReturn($room);



        $this->expectsEvents([RoomDeleted::class]);


        $response = $roomDeletionController($application,$request, $apiResponse,$user,$room);


        $this->assertSame(200, $response->getStatusCode());
    }


}
