<?php

namespace OP\Playlist\Listeners;

use OP\Playlist\Entities\PlaylistSongInterface;
use OP\Playlist\Events\PlaylistReplayed;

class ReplayPlaylist
{
    private $playlistSong;

    public function __construct(PlaylistSongInterface $playlistSong)
    {
        $this->playlistSong = $playlistSong;
    }

    public function handle(PlaylistReplayed $event)
    {
       $this->playlistSong->replayPlaylistSongs($event->getService()->getPlaylistId());

    }
}
