<?php

namespace OP\Playlist\Exceptions;

use OP\Services\Exceptions\ResponseableException;

class PlaylistSongDoesNotBelongsToUser extends \Exception implements ResponseableException
{
    public function getResponseMessage()
    {
        return "Playlist Song does not belong to you";
    }
}
