<?php

namespace OP\Playlist\Listeners;

use OP\Playlist\Entities\PlaylistInterface;
use OP\Playlist\Events\PlaylistCreated;

class CreatePlaylist
{
    private $playlist;

    public function __construct(PlaylistInterface $playlist)
    {
        $this->playlist = $playlist;

    }

    public function handle(PlaylistCreated $event)
    {
        $this->playlist->create($event->getService());
    }
}


