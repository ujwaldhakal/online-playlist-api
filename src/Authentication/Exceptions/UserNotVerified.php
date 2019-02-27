<?php

namespace OP\Authentication\Exceptions;

use OP\Services\Exceptions\ResponseableException;

class UserNotVerified extends \Exception implements ResponseableException
{
    public function getResponseMessage()
    {
        return "Please verify your email";
    }

}
