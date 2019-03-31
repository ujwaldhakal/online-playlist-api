<?php

namespace OP\Playlist\Exceptions;

use OP\Services\Exceptions\ResponseableException;

class PlaylistSongDoesNotExist extends \Exception implements ResponseableException
{

    public function getResponseMessage()
    {
        return "Playlist song does not exist";
    }
}
