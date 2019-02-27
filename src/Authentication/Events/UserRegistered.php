<?php

namespace OP\Authentication\Events;

use OP\Authentication\Services\UserRegistrationService;

class UserRegistered
{
    private $service;

    public function __construct(UserRegistrationService $service)
    {
        $this->service = $service;
    }

    public function getService(): UserRegistrationService
    {
        return $this->service;
    }
}
