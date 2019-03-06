<?php

namespace OP\Room\Entities;

use Illuminate\Database\Eloquent\Model;
use OP\Authentication\Services\UserRegistrationService;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use OP\Room\Services\RoomCreationService;
use OP\Room\Services\RoomDeletionService;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Room extends Model implements RoomInterface
{
    public $incrementing = false;

    public function create(RoomCreationService $service)
    {
        return $this->insert($service->extract());
    }

    public function remove(RoomDeletionService $service)
    {
        return $this->where('id', $service->getId())->delete();
    }

    public function findById($id)
    {
        return $this->find($id);
    }

    public function findbySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }

    public function getCreatorId()
    {
        return $this->creator_id;
    }
}
