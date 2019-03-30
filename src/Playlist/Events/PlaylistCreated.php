<?php

namespace OP\Playlist\Events;

use OP\Playlist\Services\PlaylistCreationService;

class PlaylistCreated
{
    private $service;

    public function __construct(PlaylistCreationService $service)
    {
        $this->service = $service;
    }

    public function getService(): PlaylistCreationService
    {
        return $this->service;
    }
}
