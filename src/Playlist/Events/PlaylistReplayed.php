<?php

namespace OP\Playlist\Events;

use OP\Playlist\Services\AutoChangeSongService;
use OP\Playlist\Services\ReplayService;

class PlaylistReplayed
{
    private $service;

    public function __construct(ReplayService $service)
    {
        $this->service = $service;
    }

    public function getService(): ReplayService
    {
        return $this->service;
    }

}
