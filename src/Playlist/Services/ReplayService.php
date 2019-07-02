<?php

namespace OP\Playlist\Services;

use OP\Authentication\Entities\LoggedInUser;
use OP\Playlist\Entities\PlaylistInterface;
use OP\Playlist\Exceptions\PlaylistDoesNotExist;

class ReplayService
{
    private $formData;
    private $user;
    private $playlist;
    private $playlistId;

    public function __construct($playlistId, LoggedInUser $user, PlaylistInterface $playlist)
    {
        $this->user = $user;
        $this->playlistId = $playlistId;
        $this->playlist = $playlist;
        $this->runDataValidation();
    }

    private function runDataValidation()
    {
        $this->playlist = $this->playlist->findById($this->playlistId);
        $this->checkIfPlaylistExists();
    }

    private function checkIfPlaylistExists()
    {
        if (!$this->playlist) {
            throw new PlaylistDoesNotExist();
        }
    }

    public function getPlaylistId()
    {
        return $this->playlistId;
    }


}
