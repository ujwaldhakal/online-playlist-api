<?php

namespace OP\Room\Events;

use OP\Room\Services\PlayPlaylist;

class PlaylistPlayed
{
    private $service;

    public function __construct(PlayPlaylist $service)
    {
        $this->service = $service;
    }

    public function getService(): PlayPlaylist
    {
        return $this->service;
    }
}
