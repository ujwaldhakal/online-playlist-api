<?php

namespace OP\Room\Listeners;

use OP\Playlist\Entities\PlaylistQueueInterface;
use OP\Playlist\Events\PlaylistCreated;
use OP\Playlist\Services\PlaylistCreationService;
use OP\Room\Events\RoomCreated;

class CreateDefaultPlaylist
{
    private $playlistQueue;

    public function __construct(PlaylistQueueInterface $playlistQueue)
    {
        $this->playlistQueue = $playlistQueue;
    }


    public function handle(RoomCreated $event)
    {
        $playlistCreatonService = app()->make(PlaylistCreationService::class, [
            'formData' => ['name' => 'default-room-' . $event->getService()->getSlug()]
        ]);
        event(new PlaylistCreated($playlistCreatonService));


        $this->playlistQueue->insert([
            'id' => getUuid(),
            'room_id' => $event->getService()->getId(),
            'playlist_id' => $playlistCreatonService->getId(),
            'is_playing' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

    }
}
