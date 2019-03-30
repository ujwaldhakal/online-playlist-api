<?php

namespace OP\Playlist\Exceptions;

use OP\Services\Exceptions\ResponseableException;

class PlaylistNameAlreadyExists extends \Exception implements ResponseableException
{
    public function getResponseMessage()
    {
        return "Playlist with given name already exists please choose another name";
    }
}
