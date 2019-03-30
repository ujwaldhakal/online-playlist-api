<?php

namespace tests\src\Playlist\Services;

use OP\Authentication\Entities\User;
use OP\Playlist\Entities\Playlist;
use OP\Playlist\Exceptions\PlaylistDoesNotBelongsToUser;
use OP\Playlist\Exceptions\PlaylistDoesNotExist;
use OP\Playlist\Services\PlaylistDeletionService;

class PlaylistDeletionServiceTest extends \TestCase
{
    protected $playlist;
    protected $user;

    public function basicSetup()
    {
        $this->playlist = \Mockery::mock(Playlist::class);
        $this->user = \Mockery::mock(User::class);
    }


    public function testWhenPlaylistDoesNotExist()
    {
        $this->basicSetup();
        $this->playlist->shouldReceive('findById')->andReturn(false);
        $this->expectException(PlaylistDoesNotExist::class);
        $playlistDeletionService = new PlaylistDeletionService('1213123123', $this->user, $this->playlist);
    }

    public function testWhenProvidedSomeoneTriesToDeletePlaylistThatTheyDontOwn()
    {
        $this->basicSetup();
        $this->playlist->shouldReceive('findById')->andReturn($this->playlist);
        $this->playlist->shouldReceive('getCreatorId')->andReturn(5);
        $this->user->shouldReceive('getId')->andReturn(1);
        $this->expectException(PlaylistDoesNotBelongsToUser::class);
        $playlistDeletionService = new PlaylistDeletionService('1213123123', $this->user, $this->playlist);
    }

    public function testWhenProvidedAllValidData()
    {
        $this->basicSetup();
        $this->playlist->shouldReceive('findById')->andReturn($this->playlist);
        $this->playlist->shouldReceive('getCreatorId')->andReturn(5);
        $this->user->shouldReceive('getId')->andReturn(5);
        $playlistDeletionService = new PlaylistDeletionService('1213123123', $this->user, $this->playlist);
    }

}
