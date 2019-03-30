<?php

namespace OP\Playlist\Resolver;

use OP\Authentication\Events\UserRegistered;
use OP\Authentication\Listeners\RegisterUser;
use OP\Playlist\Events\PlaylistCreated;
use OP\Playlist\Events\PlaylistDeleted;
use OP\Playlist\Events\SongAdded;
use OP\Playlist\Events\SongRemoved;
use OP\Playlist\Listeners\AddSong;
use OP\Playlist\Listeners\CreatePlaylist;
use OP\Playlist\Listeners\DeletePlaylist;
use OP\Playlist\Listeners\RemoveSong;

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
            PlaylistCreated::class => [
                CreatePlaylist::class
            ],

            PlaylistDeleted::class => [
                DeletePlaylist::class
            ],

            SongAdded::class => [
                AddSong::class
            ],

            SongRemoved::class => [
                RemoveSong::class
            ]

        ];
    }
}
