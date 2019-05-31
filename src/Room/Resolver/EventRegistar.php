<?php

namespace OP\Room\Resolver;

use OP\Room\Events\PlaylistPlayed;
use OP\Room\Events\RoomCreated;
use OP\Room\Events\RoomDeleted;
use OP\Room\Events\RoomUpdated;
use OP\Room\Events\SongAddedToDefaultPlaylist;
use OP\Room\Listeners\AddSongToCurrentPlaylist;
use OP\Room\Listeners\CreateDefaultPlaylist;
use OP\Room\Listeners\CreateRoom;
use OP\Room\Listeners\DeleteRoom;
use OP\Room\Listeners\PlayPlaylist;
use OP\Room\Listeners\UpdateRoom;

class EventRegistar
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;

    }

    public static function getRegisteredEvents()
    {
        return [
            RoomCreated::class => [
                CreateRoom::class,
                CreateDefaultPlaylist::class
            ],

            RoomDeleted::class => [
                DeleteRoom::class
            ],

            RoomUpdated::class => [
                UpdateRoom::class
            ],

            PlaylistPlayed::class => [
                PlayPlaylist::class
            ],

            SongAddedToDefaultPlaylist::class => [
                AddSongToCurrentPlaylist::class
            ]
        ];
    }
}
