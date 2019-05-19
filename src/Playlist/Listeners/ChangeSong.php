<?php

namespace OP\Playlist\Listeners;

use OP\Playlist\Entities\PlaylistInterface;
use OP\Playlist\Entities\PlaylistSongInterface;
use OP\Playlist\Events\AutoSongChanged;

class ChangeSong
{
    private $playlistSong;
    private $playlist;

    public function __construct(PlaylistSongInterface $playlistSong, PlaylistInterface $playlist)
    {
        $this->playlistSong = $playlistSong;
        $this->playlist = $playlist;
    }

    public function handle(AutoSongChanged $event)
    {
        $service = $event->getService();
        $playlistSong = $this->playlistSong->findByPlaylistId($service->getPlaylistId());
        $currentSongId = $service->getCurrentPlayingSongId();
        $playNextSong = false;
        $currentPlayingSongIndex = $playlistSong->each(function ($item) use (&$playNextSong, $currentSongId) {

            if ($item->isPlaying() && $item->getId() === $currentSongId) {
                $item->stopCurrentSong();
                $item->save();
                $playNextSong = true;
                return;
            }

            if (!$item->isPlaying() && $playNextSong) {
                $item->playCurrentSong();
                $item->save();
                $playNextSong = false;
                return false;
            }


        });

    }
}
