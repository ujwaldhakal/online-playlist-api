<?php

namespace OP\Playlist\Resolver;


class Routes
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function registerRoutes()
    {
        $this->mapPlaylistRoutes();
    }


    private function mapPlaylistRoutes()
    {
        $this->app->router->group([], function ($router) {
            require dirname(__DIR__, 1) . '/Routes/playlist.php';
        });
    }
}
