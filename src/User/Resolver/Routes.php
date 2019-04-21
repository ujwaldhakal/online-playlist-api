<?php

namespace OP\User\Resolver;

class Routes
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function registerRoutes()
    {
        $this->mapUserInfoRoutes();
    }


    private function mapUserInfoRoutes()
    {

        $this->app->router->group([
            'middleware' => 'auth'
        ], function ($router) {
            require dirname(__DIR__, 1) . '/Routes/info.php';
        });

    }
}
