<?php

namespace OP\Playlist\Entities;

use OP\Playlist\Services\PlaylistDeletionService;
use OP\Room\Services\PlayPlaylist as PlayPlaylistService;
use OP\Services\Entities\AbstractEntities;

class PlaylistQueue extends AbstractEntities implements PlaylistQueueInterface
{
    public $incrementing = false;

    public function create(PlayPlaylistService $service)
    {
        return $this->insert($service->extract());
    }


    public function changePlaylist(PlayPlaylistService $service)
    {
        $this->where(['room_id' => $service->getRoomId()])->update(['is_playing' => 0]);
        return $this->where(['room_id' => $service->getRoomId(), 'playlist_id' => $service->getPlaylistId()])->update(['is_playing' => 1]);
    }

    public function remove(PlaylistDeletionService $service)
    {
        return $this->where(['id' => $service->getId()])->delete();
    }


    public function findByRoomAndPlaylistId($roomId, $playlistId)
    {
        return $this->where(['room_id' => $roomId, 'playlist_id' => $playlistId]);
    }


    public function findByRoomId($roomId)
    {
        return $this->where(['room_id' => $roomId]);
    }

    public function getCreatorId(): string
    {
        return $this->created_by;
    }

    public function getPlaylistId(): string
    {
        return $this->playlist_id;
    }
}
