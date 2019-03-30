<?php

namespace tests\Unit\src\Playlist\Events;

use Illuminate\Support\Facades\Event;
use OP\Authentication\Entities\User;
use OP\Playlist\Events\PlaylistCreated;
use OP\Playlist\Listeners\CreatePlaylist;
use OP\Playlist\Services\PlaylistCreationService;
use OP\Room\Entities\Room;
use OP\Room\Events\RoomCreated;
use OP\Room\Listeners\CreateRoom;
use OP\Room\Services\RoomCreationService;

class PlaylistCreatedTest extends \TestCase
{
    public function testListenersWhenEventIsFired()
    {
        $createPlaylistListener = \Mockery::spy(CreatePlaylist::class);
        app()->instance(CreatePlaylist::class, $createPlaylistListener);
        $roomCreationService = \Mockery::mock(PlaylistCreationService::class);
        \event(new PlaylistCreated($roomCreationService));
        $createPlaylistListener->shouldHaveReceived('handle');
    }
}
