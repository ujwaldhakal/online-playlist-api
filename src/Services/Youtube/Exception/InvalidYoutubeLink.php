<?php

namespace OP\Services\Youtube\Exception;

use OP\Services\Exceptions\ResponseableException;

class InvalidYoutubeLink extends \Exception implements ResponseableException
{
    public function getResponseMessage()
    {
        return "Invalid youtube link";
    }

}
