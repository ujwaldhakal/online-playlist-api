<?php

namespace OP\Playlist\Resolver;

use OP\Playlist\Events\AutoSongChanged;
use OP\Playlist\Events\PlaylistCreated;
use OP\Playlist\Events\PlaylistDeleted;
use OP\Playlist\Events\SongAdded;
use OP\Playlist\Events\SongPlayed;
use OP\Playlist\Events\SongRemoved;
use OP\Playlist\Listeners\AddSong;
use OP\Playlist\Listeners\ChangeSong;
use OP\Playlist\Listeners\CreatePlaylist;
use OP\Playlist\Listeners\DeletePlaylist;
use OP\Playlist\Listeners\MarkCurrentSongAsPlaying;
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

            SongPlayed::class => [
              MarkCurrentSongAsPlaying::class
            ],

            SongRemoved::class => [
                RemoveSong::class
            ],

            AutoSongChanged::class => [
                ChangeSong::class
            ]

        ];
    }
}
