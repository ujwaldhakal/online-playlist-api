<?php

namespace OP\Playlist\Listeners;

use OP\Playlist\Entities\PlaylistInterface;
use OP\Playlist\Entities\PlaylistSongInterface;
use OP\Playlist\Events\PlaylistCreated;
use OP\Playlist\Events\SongAdded;

class AddSong
{
    private $playlistSong;

    public function __construct(PlaylistSongInterface $playlistSong)
    {
        $this->playlistSong = $playlistSong;

    }

    public function handle(SongAdded $event)
    {
        $this->playlistSong->create($event->getService());
    }
}


