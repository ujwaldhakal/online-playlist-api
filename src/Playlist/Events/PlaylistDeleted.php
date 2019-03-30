<?php

namespace OP\Playlist\Events;

use OP\Playlist\Services\PlaylistDeletionService;

class PlaylistDeleted
{
    private $service;

    public function __construct(PlaylistDeletionService $service)
    {
        $this->service = $service;
    }

    public function getService(): PlaylistDeletionService
    {
        return $this->service;
    }
}
