<?php

namespace OP\Authentication\Resolver;

use Illuminate\Database\Connection;
use OP\Authentication\Entities\User;
use OP\Authentication\Entities\UserInterface;

class BindClass
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;

    }

    public function bind()
    {
        $this->app->bind(UserInterface::class, function () {
            return new User(app(Connection::class));
        });
    }
}
