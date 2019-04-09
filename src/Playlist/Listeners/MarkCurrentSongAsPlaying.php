<?php

namespace OP\Playlist\Listeners;


use OP\Playlist\Entities\PlaylistSongInterface;
use OP\Playlist\Events\SongPlayed;

class MarkCurrentSongAsPlaying
{
    private $playlistSong;

    public function __construct(PlaylistSongInterface $playlistSong)
    {
        $this->playlistSong = $playlistSong;
    }

    public function handle(SongPlayed $event)
    {
        $this->playlistSong->stopPlaylist($event->getService());
        $this->playlistSong->playSong($event->getService());
    }
}
