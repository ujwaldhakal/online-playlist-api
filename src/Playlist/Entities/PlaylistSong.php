<?php

namespace OP\Playlist\Entities;

use OP\Playlist\Services\AddSongService;
use OP\Playlist\Services\CurrentPlayingService;
use OP\Playlist\Services\RemoveSongService;
use OP\Services\Entities\AbstractEntities;

class PlaylistSong extends AbstractEntities implements PlaylistSongInterface
{
    public $incrementing = false;

    public function create(AddSongService $service)
    {
        return $this->insert($service->extract());
    }

    public function remove(RemoveSongService $service)
    {
        return $this->where(['id' => $service->getId()])->delete();
    }

    public function stopPlaylist(CurrentPlayingService $service)
    {
        return $this->where(['playlist_id' => $service->getPlaylistId()])->update(['is_playing' => 0]);
    }

    public function playSong(CurrentPlayingService $service)
    {
        return $this->where(['id' => $service->getSongId()])->update(['is_playing' => 1]);
    }

    public function findByPlaylistId($playlistId)
    {
        return $this->where(['playlist_id' => $playlistId]);
    }

    public function stopCurrentSong()
    {
        $this->is_playing = 0;
    }

    public function playCurrentSong()
    {
        $this->is_playing = 1;
    }

    public function makrAsPlayedAlready()
    {
        $this->already_played = 1;
    }

    public function getPlaylistId(): string
    {
        return $this->playlist_id;
    }

    public function getCreatorId(): string
    {
        return $this->created_by;
    }

    public function isPlaying(): bool
    {
        return $this->is_playing;
    }
}
