<?php

namespace OP\Room\Exceptions;

use OP\Services\Exceptions\ResponseableException;

class CannotDeleteOthersRoom extends \Exception implements ResponseableException
{
    public function getResponseMessage()
    {
        return "You cannot delete others room";
    }
}
