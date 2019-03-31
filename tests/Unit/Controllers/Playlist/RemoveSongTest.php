<?php

namespace tests\Unit\Controllers;

use App\Http\Controllers\Playlist\DeletePlaylist;
use App\Http\Controllers\Playlist\RemoveSong;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use OP\Authentication\Entities\User;
use OP\Playlist\Entities\Playlist;
use OP\Playlist\Entities\PlaylistSong;
use OP\Playlist\Events\PlaylistDeleted;
use OP\Playlist\Events\SongRemoved;
use OP\Room\Entities\Room;
use OP\Room\Events\RoomCreated;
use OP\Room\Events\RoomDeleted;
use OP\Services\Response\ApiResponse;

class RemoveSongTest extends \TestCase
{
    public function testWhenInvalidSongIdIsProvided()
    {
        $playlistDeletionController = new RemoveSong();


        $request = \Mockery::mock(Request::class)->shouldAllowMockingProtectedMethods();
        $request->songId = 1;
        $user = \Mockery::mock(User::class)->makePartial();
        $playlistSong = \Mockery::mock(PlaylistSong::class)->makePartial();
        $application = app();
        $apiResponse = new ApiResponse();
        $this->withoutEvents();

        $user->shouldReceive('getId')->andReturn(1);
        $playlistSong->shouldReceive('findById')->andReturn(false);


        $response = $playlistDeletionController($application, $request, $apiResponse, $user, $playlistSong);

        $this->assertSame(400, $response->getStatusCode());
        $this->assertSame('Playlist song does not exist', $response->getMessage());
    }


    public function testWhenUserTriesToDeleteOthersPlaylistSong()
    {
        $playlistDeletionController = new RemoveSong();


        $request = \Mockery::mock(Request::class)->shouldAllowMockingProtectedMethods();
        $request->songId = 1;
        $user = \Mockery::mock(User::class)->makePartial();
        $playlistSong = \Mockery::mock(PlaylistSong::class)->makePartial();
        $application = app();
        $apiResponse = new ApiResponse();
        $this->withoutEvents();
        $user->shouldReceive('getId')->andReturn(1);
        $playlistSong->shouldReceive('findById')->andReturn($playlistSong);
        $playlistSong->shouldReceive('getCreatorId')->andReturn(2);
        $response = $playlistDeletionController($application, $request, $apiResponse, $user, $playlistSong);
        $this->assertSame(400, $response->getStatusCode());
        $this->assertSame('Playlist Song does not belong to you', $response->getMessage());
    }




    public function testDeleteWhenAllDataAreValid()
    {
        $playlistDeletionController = new RemoveSong();
        $request = \Mockery::mock(Request::class)->shouldAllowMockingProtectedMethods();
        $request->songId = 1;
        $user = \Mockery::mock(User::class)->makePartial();
        $playlistSong = \Mockery::mock(PlaylistSong::class)->makePartial();
        $application = app();
        $apiResponse = new ApiResponse();
        $this->withoutEvents();
        $user->shouldReceive('getId')->andReturn(1);
        $playlistSong->shouldReceive('findById')->andReturn($playlistSong);
        $playlistSong->shouldReceive('getCreatorId')->andReturn(1);
        $this->expectsEvents([SongRemoved::class]);
        $response = $playlistDeletionController($application, $request, $apiResponse, $user, $playlistSong);
        $this->assertSame(200, $response->getStatusCode());
    }
}
