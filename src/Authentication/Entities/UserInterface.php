<?php

namespace OP\Authentication\Entities;

use OP\Authentication\Services\UserRegistrationService;

interface UserInterface
{
    public function create(UserRegistrationService $service);
}
