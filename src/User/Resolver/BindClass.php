<?php

namespace OP\User\Resolver;

class BindClass
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function bind()
    {
        $this->app->bind(PlaylistInterface::class, function () {
            return new Playlist();
        });

        $this->app->bind(PlaylistSongInterface::class, function () {
            return new PlaylistSong();
        });
    }
}
