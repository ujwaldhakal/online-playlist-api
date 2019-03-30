<?php

namespace tests\Unit\src\Playlist\Events;

use Illuminate\Support\Facades\Event;
use OP\Authentication\Entities\User;
use OP\Playlist\Events\PlaylistCreated;
use OP\Playlist\Events\PlaylistDeleted;
use OP\Playlist\Listeners\CreatePlaylist;
use OP\Playlist\Listeners\DeletePlaylist;
use OP\Playlist\Services\PlaylistCreationService;
use OP\Playlist\Services\PlaylistDeletionService;
use OP\Room\Entities\Room;
use OP\Room\Events\RoomCreated;
use OP\Room\Listeners\CreateRoom;
use OP\Room\Services\RoomCreationService;

class PlaylistDeletedTest extends \TestCase
{
    public function testListenersWhenEventIsFired()
    {
        $deletePlaylistListener = \Mockery::spy(DeletePlaylist::class);
        app()->instance(DeletePlaylist::class, $deletePlaylistListener);
        $playlistDeletionService = \Mockery::mock(PlaylistDeletionService::class);
        \event(new PlaylistDeleted($playlistDeletionService));
        $deletePlaylistListener->shouldHaveReceived('handle');
    }
}
