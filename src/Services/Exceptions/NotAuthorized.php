<?php

namespace OP\Services\Exceptions;

class NotAuthorized extends \Exception implements ResponseableException
{
    public function getResponseMessage()
    {
        return "You don't have authority to perform this action";
    }
}
