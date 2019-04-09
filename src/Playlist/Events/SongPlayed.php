<?php

namespace OP\Playlist\Events;

use OP\Playlist\Services\CurrentPlayingService;

class SongPlayed
{
    private $service;

    public function __construct(CurrentPlayingService $service)
    {
        $this->service = $service;
    }

    public function getService(): CurrentPlayingService
    {
        return $this->service;
    }
}
