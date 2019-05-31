<?php

namespace OP\Room\Entities;

use Illuminate\Database\Eloquent\Model;
use OP\Authentication\Services\UserRegistrationService;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use OP\Playlist\Entities\PlaylistQueue;
use OP\Room\Services\RoomCreationService;
use OP\Room\Services\RoomDeletionService;
use OP\Room\Services\RoomUpdateService;
use OP\Services\Entities\AbstractEntities;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Room extends AbstractEntities implements RoomInterface
{
    public $incrementing = false;

    public function create(RoomCreationService $service)
    {
        return $this->insert($service->extract());
    }

    public function updateData(RoomUpdateService $service)
    {
        return $this->where(['id' => $service->getId()])->update($service->extract());
    }

    public function remove(RoomDeletionService $service)
    {
        return $this->where('id', $service->getId())->delete();
    }

    public function getCreatorId(): string
    {
        return $this->creator_id;
    }

    public function getDjId(): string
    {
        return $this->dj_id;
    }


}
