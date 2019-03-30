<?php

namespace tests\Unit\src\Playlist\Events;

use Illuminate\Support\Facades\Event;
use OP\Authentication\Entities\User;
use OP\Playlist\Events\PlaylistCreated;
use OP\Playlist\Events\SongAdded;
use OP\Playlist\Listeners\AddSong;
use OP\Playlist\Listeners\CreatePlaylist;
use OP\Playlist\Services\AddSongService;
use OP\Playlist\Services\PlaylistCreationService;
use OP\Room\Entities\Room;
use OP\Room\Events\RoomCreated;
use OP\Room\Listeners\CreateRoom;
use OP\Room\Services\RoomCreationService;

class SongAddedTest extends \TestCase
{
    public function testListenersWhenEventIsFired()
    {
        $addSongListener = \Mockery::spy(AddSong::class);
        app()->instance(AddSong::class, $addSongListener);
        $addSongService = \Mockery::mock(AddSongService::class);
        \event(new SongAdded($addSongService));
        $addSongListener->shouldHaveReceived('handle');
    }
}
