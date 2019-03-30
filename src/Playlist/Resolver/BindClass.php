<?php

namespace OP\Playlist\Resolver;

use Illuminate\Database\Connection;
use OP\Authentication\Entities\LoggedInUser;
use OP\Authentication\Entities\User;
use OP\Authentication\Entities\UserInterface;
use OP\Playlist\Entities\Playlist;
use OP\Playlist\Entities\PlaylistInterface;
use OP\Playlist\Entities\PlaylistSong;
use OP\Playlist\Entities\PlaylistSongInterface;
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
        $this->app->bind(PlaylistInterface::class, function () {
            return new Playlist();
        });

        $this->app->bind(PlaylistSongInterface::class, function () {
            return new PlaylistSong();
        });
    }
}
