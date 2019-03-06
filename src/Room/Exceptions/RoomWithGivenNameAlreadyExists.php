<?php

namespace OP\Room\Exceptions;

use OP\Services\Exceptions\ResponseableException;

class RoomWithGivenNameAlreadyExists extends \Exception implements ResponseableException
{
    public function getResponseMessage()
    {
        return "Given name already exists";
    }

}
