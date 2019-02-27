<?php

namespace OP\Authentication\Resolver;

use Illuminate\Database\Connection;
use OP\Authentication\Entities\User;
use OP\Authentication\Entities\UserInterface;
use OP\Services\Auth\Auth;
use OP\Services\Auth\AuthInterface;
use Tymon\JWTAuth\JWTAuth;

class BindClass
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function bind()
    {
        $this->app->bind(AuthInterface::class, function () {
            return app(Auth::class);
        });

        $this->app->bind(UserInterface::class, function () {
            return new User();
        });
    }
}
