<?php

namespace OP\Services\Auth;

use Tymon\JWTAuth\JWTAuth;

class Auth extends JWTAuth implements AuthInterface
{
    public function getTokenExpiry() : int
    {
        return $this->factory()->getTTL() * 60;
    }
}
