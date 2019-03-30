<?php

namespace OP\Playlist\Entities;

use Illuminate\Database\Eloquent\Model;
use OP\Playlist\Services\PlaylistCreationService;
use OP\Services\Entities\AbstractEntities;

class Playlist extends AbstractEntities implements PlaylistInterface
{
    public $incrementing = false;

    public function create(PlaylistCreationService $service)
    {
        return $this->insert($service->extract());
    }
}
