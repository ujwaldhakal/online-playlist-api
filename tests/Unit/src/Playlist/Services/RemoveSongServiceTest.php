<?php

namespace tests\src\Playlist\Services;

use OP\Authentication\Entities\User;
use OP\Playlist\Entities\Playlist;
use OP\Playlist\Entities\PlaylistSong;
use OP\Playlist\Exceptions\PlaylistDoesNotBelongsToUser;
use OP\Playlist\Exceptions\PlaylistDoesNotExist;
use OP\Playlist\Exceptions\PlaylistSongDoesNotBelongsToUser;
use OP\Playlist\Exceptions\PlaylistSongDoesNotExist;
use OP\Playlist\Services\PlaylistDeletionService;
use OP\Playlist\Services\RemoveSongService;

class RemoveSongServiceTest extends \TestCase
{
    protected $playlistSong;
    protected $user;

    public function basicSetup()
    {
        $this->playlistSong = \Mockery::mock(PlaylistSong::class);
        $this->user = \Mockery::mock(User::class);
    }


    public function testWhenPlaylistSongDoesNotExist()
    {
        $this->basicSetup();
        $this->playlistSong->shouldReceive('findById')->andReturn(false);
        $this->expectException(PlaylistSongDoesNotExist::class);
        $playlistDeletionService = new RemoveSongService('1213123123', $this->user, $this->playlistSong);
    }

    public function testWhenProvidedSomeoneTriesToDeletePlaylistThatTheyDontOwn()
    {
        $this->basicSetup();
        $this->playlistSong->shouldReceive('findById')->andReturn($this->playlistSong);
        $this->playlistSong->shouldReceive('getCreatorId')->andReturn(5);
        $this->user->shouldReceive('getId')->andReturn(1);
        $this->expectException(PlaylistSongDoesNotBelongsToUser::class);
        $playlistDeletionService = new RemoveSongService('1213123123', $this->user, $this->playlistSong);
    }


    public function testWhenProvidedAllValidData()
    {
        $this->basicSetup();
        $this->playlistSong->shouldReceive('findById')->andReturn($this->playlistSong);
        $this->playlistSong->shouldReceive('getCreatorId')->andReturn(5);
        $this->user->shouldReceive('getId')->andReturn(5);
        $playlistDeletionService = new RemoveSongService('1213123123', $this->user, $this->playlistSong);
    }

}
