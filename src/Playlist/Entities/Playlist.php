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

    public function getSlug()
    {
        return $this->slug;
    }

    public function findByUserAndSlug($userId, $slug)
    {
        return $this->findWhere(['created_by' => $userId, 'slug' => $slug]);
    }
}
