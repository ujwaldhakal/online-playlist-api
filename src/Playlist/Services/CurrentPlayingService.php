<?php

namespace OP\Playlist\Services;

use OP\Authentication\Entities\LoggedInUser;
use OP\Playlist\Entities\PlaylistSongInterface;
use OP\Playlist\Exceptions\PlaylistSongDoesNotExist;

class CurrentPlayingService
{
    private $songId;
    private $user;
    private $playlistSong;

    public function __construct($songId, LoggedInUser $user, PlaylistSongInterface $playlistSong)
    {
        $this->songId = $songId;
        $this->user = $user;
        $this->playlistSong = $playlistSong;
        $this->runDataValidation();
    }


    private function runDataValidation()
    {
        $this->playlistSong = $this->playlistSong->findById($this->songId);

        if (!$this->playlistSong) {
            throw new PlaylistSongDoesNotExist();
        }
    }

    public function getSongId()
    {
        return $this->songId;
    }


    public function getPlaylistId()
    {
        return $this->playlistSong->getPlaylistId();
    }

}
