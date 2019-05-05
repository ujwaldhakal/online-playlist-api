<?php

namespace OP\Room\Listeners;


use OP\Playlist\Entities\PlaylistQueueInterface;
use OP\Room\Events\PlaylistPlayed;

class PlayPlaylist
{
    private $playlistQueue;

    public function __construct(PlaylistQueueInterface $playlistQueue)
    {
        $this->playlistQueue = $playlistQueue;
    }

    public function handle(PlaylistPlayed $event)
    {
        $service = $event->getService();
        $record = $this->playlistQueue->findByRoomAndPlaylistId($service->getRoomId(),$service->getPlaylistId())->first();

        if(!$record) {
            $this->playlistQueue->create($event->getService());
        }

        if($record) {
            $this->playlistQueue->changePlaylist($event->getService());
        }

    }
}
