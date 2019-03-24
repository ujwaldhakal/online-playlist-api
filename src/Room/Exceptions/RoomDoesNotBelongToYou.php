<?php

namespace OP\Room\Exceptions;


use OP\Services\Exceptions\ResponseableException;

class RoomDoesNotBelongToYou extends \Exception implements ResponseableException
{
    public function getResponseMessage()
    {
        return "Room does not belong to you";
    }

}
