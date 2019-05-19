<?php

namespace OP\Playlist\Events;

use OP\Playlist\Services\AutoChangeSongService;

class AutoSongChanged
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
}
