<?php

namespace OP\Playlist\Entities;

use Illuminate\Database\Eloquent\Model;
use OP\Playlist\Services\PlaylistCreationService;
use OP\Playlist\Services\PlaylistDeletionService;
use OP\Services\Entities\AbstractEntities;

class Playlist extends AbstractEntities implements PlaylistInterface
{
    public $incrementing = false;

    public function create(PlaylistCreationService $service)
    {
        return $this->insert($service->extract());
    }

    public function remove(PlaylistDeletionService $service)
    {
        return $this->where(['id' => $service->getId()])->delete();
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function findByUserAndSlug($userId, $slug)
    {
        return $this->findWhere(['created_by' => $userId, 'slug' => $slug]);
    }

    public function findByCreatorId($id)
    {
        return $this->findWhere(['created_by' => $id]);
    }

    public function getCreatorId(): string
    {
        return $this->created_by;
    }
}
