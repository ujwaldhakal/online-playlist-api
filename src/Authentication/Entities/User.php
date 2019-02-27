<?php

namespace OP\Authentication\Entities;

use Illuminate\Database\Eloquent\Model;
use OP\Authentication\Services\UserRegistrationService;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements UserInterface, AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable;


    const VERIFIED_USER = 1;

    public function create(UserRegistrationService $service)
    {
        return $this->insert($service->extract());
    }

    public function findByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function isVerified(): bool
    {
        return $this->is_verified === self::VERIFIED_USER;
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
