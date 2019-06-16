<?php

namespace OP\Playlist\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use OP\Playlist\Services\AutoChangeSongService;

class AutoSongChanged implements ShouldBroadcast
{
    private $service;

    public function __construct(AutoChangeSongService $service)
    {
        $this->service = $service;
    }

    public function getService(): AutoChangeSongService
    {
        return $this->service;
    }

    public function broadcastOn()
    {
       return ['song-changed'];
    }
}
