<?php

namespace OP\Authentication\Exceptions;

use OP\Services\Exceptions\ResponseableException;

class LoginFailed extends \Exception implements ResponseableException
{
    public function getResponseMessage()
    {
        return "Invalid Credentials";
    }

}
