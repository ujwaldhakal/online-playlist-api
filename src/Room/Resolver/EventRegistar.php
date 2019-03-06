<?php

namespace OP\Room\Resolver;

use OP\Authentication\Events\UserRegistered;
use OP\Authentication\Listeners\RegisterUser;
use OP\Room\Events\RoomCreated;
use OP\Room\Events\RoomDeleted;
use OP\Room\Listeners\CreateRoom;
use OP\Room\Listeners\DeleteRoom;

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
            RoomCreated::class => [
                CreateRoom::class
            ],

            RoomDeleted::class => [
                DeleteRoom::class
            ]
        ];
    }
}
