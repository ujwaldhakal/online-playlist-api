<?php

namespace OP\Room\Resolver;

class Routes
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function registerRoutes()
    {
        $this->mapRoomRoutes();
    }

    private function mapRoomRoutes()
    {
        $this->app->router->group([
            'prefix' => 'rooms',
        ], function ($router) {
            require dirname(__DIR__, 1) . '/Routes/rooms.php';
        });
    }
}
