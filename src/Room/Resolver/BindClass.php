<?php

namespace OP\Room\Resolver;

use Illuminate\Database\Connection;
use OP\Authentication\Entities\User;
use OP\Authentication\Entities\UserInterface;
use OP\Room\Entities\Room;
use OP\Room\Entities\RoomInterface;
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
        $this->app->bind(RoomInterface::class, function () {
            return new Room();
        });
    }
}
