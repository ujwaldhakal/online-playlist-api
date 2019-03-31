<?php

namespace OP\Playlist\Services;

use Illuminate\Support\Collection;
use OP\Authentication\Entities\LoggedInUser;
use OP\Playlist\Entities\PlaylistInterface;
use OP\Playlist\Entities\PlaylistSongInterface;
use OP\Playlist\Exceptions\PlaylistDoesNotExist;
use OP\Playlist\Exceptions\PlaylistSongDoesNotBelongsToUser;
use OP\Playlist\Exceptions\PlaylistSongDoesNotExist;
use OP\Services\Write\CreateInterface;
use OP\Services\Write\DeleteInterface;

class RemoveSongService implements DeleteInterface
{
    private $playlistSong;
    private $user;
    private $id;

    public function __construct($id, LoggedInUser $user, PlaylistSongInterface $playlistSong)
    {
        $this->id = $id;
        $this->user = $user;
        $this->playlistSong = $playlistSong;
        $this->runDataValidation();
    }

    public function getId(): String
    {
        return $this->id;
    }

    private function runDataValidation()
    {
        $this->playlistSong = $this->playlistSong->findById($this->getId());
        $this->checkIfSongExists();
        $this->checkIfSongBelongsToUser();
    }




    private function checkIfSongExists()
    {
        if (!$this->playlistSong) {
            throw new PlaylistSongDoesNotExist();
        }
    }

    private function checkIfSongBelongsToUser()
    {
        if ($this->user->getId() !== $this->playlistSong->getCreatorId()) {
            throw new PlaylistSongDoesNotBelongsToUser();
        }
    }

}
