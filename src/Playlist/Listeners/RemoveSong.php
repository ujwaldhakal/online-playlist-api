<?php

namespace OP\Playlist\Listeners;


use OP\Playlist\Entities\PlaylistSongInterface;
use OP\Playlist\Events\SongRemoved;

class RemoveSong
{
    private $playlistSong;

    public function __construct(PlaylistSongInterface $playlistSong)
    {
        $this->playlistSong = $playlistSong;
    }

    public function handle(SongRemoved $event)
    {
        $this->playlistSong->remove($event->getService());
    }
}
