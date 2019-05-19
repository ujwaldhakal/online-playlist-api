<?php

namespace OP\Playlist\Services;

use OP\Playlist\Entities\PlaylistInterface;
use OP\Playlist\Entities\PlaylistSong;
use OP\Playlist\Exceptions\PlaylistDoesNotExist;
use OP\Playlist\Exceptions\PlaylistSongDoesNotExist;

class AutoChangeSongService
{
    private $playlistSong;
    private $playlistId;
    private $playlist;
    private $currentSongId;

    public function __construct(PlaylistSong $playlistSong, $playlistId, $currentSongId, PlaylistInterface $playlist)
    {
        $this->playlistSong = $playlistSong;
        $this->playlistId = $playlistId;
        $this->playlist = $playlist;
        $this->currentSongId = $currentSongId;
        $this->runDataValidation();
    }

    private function runDataValidation()
    {
        $this->checkIfCurrentSongExists();
        $this->checkIfPlaylistExists();
    }

    public function getPlaylistId()
    {
        return $this->playlistId;
    }

    public function getCurrentPlayingSongId()
    {
        return $this->currentSongId;
    }

    private function checkIfCurrentSongExists()
    {
        $this->playlistSong = $this->playlistSong->findById($this->currentSongId);

        if (!$this->playlistSong) {
            throw new PlaylistSongDoesNotExist();
        }
    }


    private function checkIfPlaylistExists()
    {
        $this->playlist = $this->playlist->findById($this->playlistId);

        if (!$this->playlist) {
            throw new PlaylistDoesNotExist();
        }
    }

}
