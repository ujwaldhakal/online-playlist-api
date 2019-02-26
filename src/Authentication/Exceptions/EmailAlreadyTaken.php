<?php

namespace OP\Authentication\Exceptions;

use OP\Services\Exceptions\ResponseableException;

class EmailAlreadyTaken extends \Exception implements ResponseableException
{
    public function getResponseMessage()
    {
        return "Email has been already taken";
    }

}
