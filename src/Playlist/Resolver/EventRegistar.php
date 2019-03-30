<?php

namespace OP\Playlist\Resolver;

use OP\Authentication\Events\UserRegistered;
use OP\Authentication\Listeners\RegisterUser;

class EventRegistar
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;

    }

    public static function getRegisteredEvents()
    {
        return [
            UserRegistered::class => [
                RegisterUser::class
            ]
        ];
    }
}
