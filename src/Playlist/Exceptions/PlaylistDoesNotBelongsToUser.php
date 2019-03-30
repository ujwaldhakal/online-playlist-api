<?php

namespace OP\Playlist\Exceptions;

use OP\Services\Exceptions\ResponseableException;

class PlaylistDoesNotBelongsToUser extends \Exception implements ResponseableException
{

    public function getResponseMessage()
    {
        return "Playlist does not belong to you";
    }
}
