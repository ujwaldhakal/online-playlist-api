<?php

namespace OP\Room\Listeners;

use OP\Playlist\Entities\PlaylistQueue;
use OP\Playlist\Entities\PlaylistSong;
use OP\Room\Events\SongAddedToDefaultPlaylist;
use OP\Services\Youtube\ExtractSongDetail;

class AddSongToCurrentPlaylist
{
    private $playlistSong;
    private $playlistQueue;

    public function __construct(PlaylistSong $playlistSong, PlaylistQueue $playlistQueue)
    {
        $this->playlistSong = $playlistSong;
        $this->playlistQueue = $playlistQueue;
    }

    public function handle(SongAddedToDefaultPlaylist $playlist)
    {
        $service = $playlist->getService();
        $youtubeService = app(ExtractSongDetail::class,[
            'songId' => $service->getYoutubeVideo()
        ]);

        $currentQueue = $this->playlistQueue->findByRoomId($service->getRoom()->getId())->first();

        $this->playlistSong->insert([
        'id' => $service->getId(),
        'link' => $service->getSongLink(),
        'created_by' => $service->getUser()->getId(),
        'playlist_id' => $currentQueue->getPlaylistId(),
        'title' => $youtubeService->getData()->getTitle(),
        'cover_image' => $youtubeService->getData()->getCoverPic(),
        'is_youtube_playlist_link' => 0,
        'is_youtube_list' => true,
        'is_playing' => 0,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ]);

    }
}
