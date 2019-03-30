<?php

namespace tests\src\Playlist\Services;

use OP\Authentication\Entities\User;
use OP\playlist\Entities\playlist;
use OP\Playlist\Exceptions\PlaylistDoesNotExist;
use OP\Playlist\Exceptions\PlaylistNameAlreadyExists;
use OP\playlist\Exceptions\playlistWithGivenNameAlreadyExists;
use OP\Playlist\Services\AddSongService;
use OP\playlist\Services\playlistCreationService;

class AddSongServiceTest extends \TestCase
{
    protected $playlist;
    protected $user;

    public function basicSetup()
    {
        $this->playlist = \Mockery::mock(Playlist::class);
        $this->user = \Mockery::mock(User::class);
    }


    public function testExceptionWhenInvalidPlaylistIsGiven()
    {
        $this->basicSetup();
        $this->user->shouldReceive('getId')->andReturn('12323');
        $this->playlist->shouldReceive('findById')->andReturn(false);
        $this->expectException(PlaylistDoesNotExist::class);
        $playlistCreationService = new AddSongService(['playlist_id' => '123'], $this->user, $this->playlist);
    }

    public function testWhenAllDataAreValid()
    {
        $this->basicSetup();
        $this->user->shouldReceive('getId')->andReturn('12323');
        $this->playlist->shouldReceive('findById')->andReturn(true);
        $playlistCreationService = new AddSongService(['playlist_id' => '123'], $this->user, $this->playlist);
    }


}
