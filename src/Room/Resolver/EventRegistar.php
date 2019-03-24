<?php

namespace OP\Room\Resolver;

use OP\Authentication\Events\UserRegistered;
use OP\Authentication\Listeners\RegisterUser;
use OP\Room\Events\RoomCreated;
use OP\Room\Events\RoomDeleted;
use OP\Room\Events\RoomUpdated;
use OP\Room\Listeners\CreateRoom;
use OP\Room\Listeners\DeleteRoom;
use OP\Room\Listeners\UpdateRoom;

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
            ],

            RoomUpdated::class => [
                UpdateRoom::class
            ]
        ];
    }
}
