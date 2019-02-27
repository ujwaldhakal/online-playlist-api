<?php

namespace OP\Authentication\Entities;

use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Model;
use OP\Authentication\Services\UserRegistrationService;
use OP\Services\AbstractWriteModel;

class User extends Model implements UserInterface
{
    public function scopefindByEmail($q, $email)
    {
        return $q->where('email', $email);
    }

    public function create(UserRegistrationService $service)
    {
        return $this->insert($service->extract());
    }
}
