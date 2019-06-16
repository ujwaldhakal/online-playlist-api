<?php

namespace OP\Playlist\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use OP\Playlist\Services\CurrentPlayingService;

class SongPlayed implements ShouldBroadcast
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

    public function broadcastOn()
    {
       return ['marked-as-current-song-playing'];
    }
}
