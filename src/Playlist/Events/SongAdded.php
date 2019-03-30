<?php

namespace OP\Playlist\Events;

use OP\Playlist\Services\AddSongService;
use OP\Playlist\Services\PlaylistCreationService;

class SongAdded
{
    private $service;

    public function __construct(AddSongService $service)
    {
        $this->service = $service;
    }

    public function getService(): AddSongService
    {
        return $this->service;
    }
}
