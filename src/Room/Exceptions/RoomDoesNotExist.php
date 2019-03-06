<?php

namespace OP\Room\Exceptions;

use OP\Services\Exceptions\ResponseableException;

class RoomDoesNotExist extends \Exception implements ResponseableException
{
    public function getResponseMessage()
    {
        return "Room does not exist";
    }
}
