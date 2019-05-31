<?php

namespace OP\Room\Events;

use OP\Room\Services\AddSongToCurrentlyPlayingPlaylistService;

class SongAddedToDefaultPlaylist
{
    private $service;

    public function __construct(AddSongToCurrentlyPlayingPlaylistService $service)
    {
        $this->service = $service;
    }

    public function getService(): AddSongToCurrentlyPlayingPlaylistService
    {
        return $this->service;
    }

}
