<?php

namespace OP\Playlist\Listeners;

use OP\Playlist\Entities\PlaylistInterface;
use OP\Playlist\Events\PlaylistDeleted;

class DeletePlaylist
{
    private $playlist;

    public function __construct(PlaylistInterface $playlist)
    {
        $this->playlist = $playlist;
    }

    public function handle(PlaylistDeleted $event)
    {
        $this->playlist->remove($event->getService());
    }
}
