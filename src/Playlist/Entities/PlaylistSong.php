<?php

namespace OP\Playlist\Entities;

use Illuminate\Database\Eloquent\Model;
use OP\Playlist\Services\AddSongService;
use OP\Playlist\Services\PlaylistCreationService;
use OP\Playlist\Services\PlaylistDeletionService;
use OP\Playlist\Services\RemoveSongService;
use OP\Services\Entities\AbstractEntities;

class PlaylistSong extends AbstractEntities implements PlaylistSongInterface
{
    public $incrementing = false;

    public function create(AddSongService $service)
    {
        return $this->insert($service->extract());
    }

    public function remove(RemoveSongService $service)
    {
        return $this->where(['id' => $service->getId()])->delete();
    }


    public function getCreatorId(): string
    {
        return $this->created_by;
    }
}
