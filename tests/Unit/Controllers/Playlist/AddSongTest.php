<?php

namespace tests\Unit\Controllers;

use App\Http\Controllers\Playlist\AddSong;
use App\Http\Controllers\Playlist\CreatePlaylist;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use OP\Authentication\Entities\User;
use OP\Playlist\Entities\Playlist;
use OP\Playlist\Events\PlaylistCreated;
use OP\Playlist\Events\SongAdded;
use OP\Room\Entities\Room;
use OP\Room\Events\RoomCreated;
use OP\Services\Response\ApiResponse;

class AddSongTest extends \TestCase
{

    public function testWhenAllRequiredFieldsAreNotGiven()
    {
        $addSongController = new AddSong();
        $request = \Mockery::mock(Request::class)->shouldAllowMockingProtectedMethods();
        $user = \Mockery::mock(User::class);
        $playlist = \Mockery::mock(Playlist::class);
        $application = app();
        $apiResponse = new ApiResponse();
        $request->shouldReceive('all')->andReturn(['name' => 'retro-songs']);
        $request->shouldReceive('only')->andReturn(['name' => 'retro-songs']);
        $user->shouldReceive('getId')->andReturn(1);
        $this->expectException(ValidationException::class);
        $response = json_decode($addSongController($application, $request, $apiResponse, $user, $playlist), true);

    }

    public function testWhenInvalidPlaylistIdIsGiven()
    {
        $addSongController = new AddSong();
        $request = \Mockery::mock(Request::class)->shouldAllowMockingProtectedMethods();
        $user = \Mockery::mock(User::class);
        $playlist = \Mockery::mock(Playlist::class);
        $application = app();
        $apiResponse = new ApiResponse();
        $request->shouldReceive('all')->andReturn(['link' => 'retro-songs', 'playlist_id' => '12312']);
        $request->shouldReceive('only')->andReturn(['link' => 'retro-songs', 'playlist_id' => '12312']);
        $user->shouldReceive('getId')->andReturn(1);
        $playlist->shouldReceive('findById')->andReturn(null);
        $response = $addSongController($application, $request, $apiResponse, $user, $playlist);
        $this->assertSame("Playlist does not exist", $response->getMessage());
        $this->assertSame(400, $response->getStatusCode());

    }

    public function testWhenAllDataAreValid()
    {
        $addSongController = new AddSong();
        $request = \Mockery::mock(Request::class)->shouldAllowMockingProtectedMethods();
        $user = \Mockery::mock(User::class);
        $playlist = \Mockery::mock(Playlist::class)->makePartial();
        $application = app();
        $apiResponse = new ApiResponse();
        $request->shouldReceive('all')->andReturn(['link' => 'retro-songs', 'playlist_id' => '12312']);
        $request->shouldReceive('only')->andReturn(['link' => 'retro-songs', 'playlist_id' => '12312']);
        $user->shouldReceive('getId')->andReturn(1);
        $playlist->shouldReceive('findById')->andReturn($playlist);
        $playlist->shouldReceive('getId')->andReturn("123");
        $this->expectsEvents([SongAdded::class]);
        $response = json_decode($addSongController($application, $request, $apiResponse, $user, $playlist),true);

        $this->assertArrayHasKey('data', $response);
        $this->assertArrayHasKey('id', $response['data']);
        $this->assertArrayHasKey('creator_id', $response['data']);
        $this->assertArrayHasKey('link', $response['data']);
        $this->assertArrayHasKey('is_played', $response['data']);
        $this->assertArrayHasKey('is_youtube_list', $response['data']);
        $this->assertArrayHasKey('is_youtube_playlist_link', $response['data']);

    }

}
