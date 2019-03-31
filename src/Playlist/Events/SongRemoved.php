<?php

namespace OP\Playlist\Events;

use OP\Playlist\Services\AddSongService;
use OP\Playlist\Services\PlaylistCreationService;
use OP\Playlist\Services\RemoveSongService;

class SongRemoved
{
    private $service;

    public function __construct(RemoveSongService $service)
    {
        $this->service = $service;
    }

    public function getService(): RemoveSongService
    {
        return $this->service;
    }
}
