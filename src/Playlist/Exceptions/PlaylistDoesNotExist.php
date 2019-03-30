<?php

namespace OP\Playlist\Exceptions;

use OP\Services\Exceptions\ResponseableException;

class PlaylistDoesNotExist extends \Exception implements ResponseableException
{

    public function getResponseMessage()
    {
        return "Playlist does not exist";
    }
}
