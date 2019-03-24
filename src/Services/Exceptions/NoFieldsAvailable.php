<?php

namespace OP\Services\Exceptions;

class NoFieldsAvailable extends \Exception implements ResponseableException
{
    public function getResponseMessage()
    {
        return "Please provide fields in url to get data (?fields=id,name)";
    }
}
