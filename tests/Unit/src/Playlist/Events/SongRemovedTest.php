<?php

namespace tests\Unit\src\Playlist\Events;

use Illuminate\Support\Facades\Event;
use OP\Authentication\Entities\User;
use OP\Playlist\Events\PlaylistCreated;
use OP\Playlist\Events\SongAdded;
use OP\Playlist\Events\SongRemoved;
use OP\Playlist\Listeners\AddSong;
use OP\Playlist\Listeners\CreatePlaylist;
use OP\Playlist\Listeners\RemoveSong;
use OP\Playlist\Services\AddSongService;
use OP\Playlist\Services\PlaylistCreationService;
use OP\Playlist\Services\RemoveSongService;
use OP\Room\Entities\Room;
use OP\Room\Events\RoomCreated;
use OP\Room\Listeners\CreateRoom;
use OP\Room\Services\RoomCreationService;

class SongRemovedTest extends \TestCase
{
    public function testListenersWhenEventIsFired()
    {
        $removeSongListener = \Mockery::spy(RemoveSong::class);
        app()->instance(RemoveSong::class, $removeSongListener);
        $removeSongService = \Mockery::mock(RemoveSongService::class);
        \event(new SongRemoved($removeSongService));
        $removeSongListener->shouldHaveReceived('handle');
    }
}
