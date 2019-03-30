<?php

namespace tests\Unit\Controllers;

use App\Http\Controllers\Playlist\CreatePlaylist;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use OP\Authentication\Entities\User;
use OP\Playlist\Entities\Playlist;
use OP\Playlist\Events\PlaylistCreated;
use OP\Room\Entities\Room;
use OP\Room\Events\RoomCreated;
use OP\Services\Response\ApiResponse;

class CreatePlaylistTest extends \TestCase
{

    public function testWhenAllDataAreValid()
    {
        $playlistCreationController = new CreatePlaylist();
        $request = \Mockery::mock(Request::class)->shouldAllowMockingProtectedMethods();
        $user = \Mockery::mock(User::class);
        $playlist = \Mockery::mock(Playlist::class);
        $application = app();
        $apiResponse = new ApiResponse();
        $request->shouldReceive('all')->andReturn(['name' => 'retro-songs']);
        $request->shouldReceive('only')->andReturn(['name' => 'retro-songs']);
        $user->shouldReceive('getId')->andReturn(1);
        $playlist->shouldReceive('findByUserAndSlug')->andReturn(false);
        $this->expectsEvents([PlaylistCreated::class]);

        $response = json_decode($playlistCreationController($application, $request, $apiResponse, $user, $playlist), true);
        $this->assertArrayHasKey('data', $response);
        $this->assertArrayHasKey('id', $response['data']);
        $this->assertArrayHasKey('name', $response['data']);
        $this->assertArrayHasKey('created_by', $response['data']);
        $this->assertArrayHasKey('slug', $response['data']);
    }

    public function testWhenAllDataAreNotValid()
    {
        $playlistCreationController = new CreatePlaylist();
        $request = \Mockery::mock(Request::class)->shouldAllowMockingProtectedMethods();
        $user = \Mockery::mock(User::class);
        $playlist = \Mockery::mock(Playlist::class);
        $application = app();
        $apiResponse = new ApiResponse();
        $request->shouldReceive('all')->andReturn(['name' => 'retro-songs']);
        $request->shouldReceive('only')->andReturn(['name' => 'retro-songs']);
        $user->shouldReceive('getId')->andReturn(1);
        $playlist->shouldReceive('findByUserAndSlug')->andReturn(true);
        $this->withoutEvents();
        $response = $playlistCreationController($application, $request, $apiResponse, $user, $playlist);
        $this->assertSame(400, $response->getStatusCode());

    }

}
