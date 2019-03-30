<?php

namespace tests\Unit\Controllers;

use App\Http\Controllers\Playlist\DeletePlaylist;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use OP\Authentication\Entities\User;
use OP\Playlist\Entities\Playlist;
use OP\Playlist\Events\PlaylistDeleted;
use OP\Room\Entities\Room;
use OP\Room\Events\RoomCreated;
use OP\Room\Events\RoomDeleted;
use OP\Services\Response\ApiResponse;

class DeletePlaylistTest extends \TestCase
{

    public function testDeleteWhenAllDataAreNotValid()
    {
        $playlistDeletionController = new DeletePlaylist();


        $request = \Mockery::mock(Request::class)->shouldAllowMockingProtectedMethods();
        $request->id = 1;
        $user = \Mockery::mock(User::class)->makePartial();
        $playlist = \Mockery::mock(Playlist::class)->makePartial();
        $application = app();
        $apiResponse = new ApiResponse();
        $this->withoutEvents();

        $user->shouldReceive('getId')->andReturn(1);
        $playlist->shouldReceive('findById')->andReturn(false);


        $response = $playlistDeletionController($application, $request, $apiResponse, $user, $playlist);


        $this->assertSame(400, $response->getStatusCode());
    }

    public function testDeleteWhenAllDataAreValid()
    {
        $playlistDeletionController = new DeletePlaylist();


        $request = \Mockery::mock(Request::class)->shouldAllowMockingProtectedMethods();
        $request->id = 1;
        $user = \Mockery::mock(User::class)->makePartial();
        $playlist = \Mockery::mock(Playlist::class)->makePartial();
        $application = app();
        $apiResponse = new ApiResponse();

        $user->shouldReceive('getId')->andReturn((int) 1);
        $playlist->shouldReceive('getCreatorId')->andReturn((int) 1);
        $playlist->shouldReceive('findById')->andReturn($playlist);


        $this->expectsEvents([PlaylistDeleted::class]);


        $response = $playlistDeletionController($application, $request, $apiResponse, $user, $playlist);


        $this->assertSame(200, $response->getStatusCode());
    }


}
