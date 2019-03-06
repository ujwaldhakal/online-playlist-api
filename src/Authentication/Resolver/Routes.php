<?php

namespace OP\Authentication\Resolver;

use OP\Authentication\Events\UserRegistered;
use OP\Authentication\Listeners\RegisterUser;

class Routes
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function registerRoutes()
    {
        $this->mapAuthRoutes();
    }


    private function mapAuthRoutes()
    {
        $this->app->router->group([], function ($router) {
            require dirname(__DIR__, 1).'/Routes/auth.php';
        });
    }
}
