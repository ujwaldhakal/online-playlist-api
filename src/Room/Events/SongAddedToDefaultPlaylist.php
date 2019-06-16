<?php

namespace OP\Room\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use OP\Room\Services\AddSongToCurrentlyPlayingPlaylistService;

class SongAddedToDefaultPlaylist implements ShouldBroadcast
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

    public function broadcastOn()
    {
       return 'song-added';
    }

}
