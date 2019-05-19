<?php

namespace App\Http\Controllers\Playlist;

use Illuminate\Http\Request;
use Laravel\Lumen\Application;
use OP\Authentication\Entities\LoggedInUser;
use OP\Playlist\Entities\PlaylistInterface;
use OP\Playlist\Entities\PlaylistSongInterface;
use OP\Playlist\Events\AutoSongChanged;
use OP\Playlist\Events\SongPlayed;
use OP\Playlist\Services\AutoChangeSongService;
use OP\Services\Exceptions\ResponseableException;
use OP\Services\Response\ApiResponse;

class AutoChangeSong
{
    public function __invoke(Application $application, Request $request, ApiResponse $response, LoggedInUser $user, PlaylistSongInterface $playlistSong, PlaylistInterface $playlist)
    {
        try {
            $songPlayingService = $application->make(AutoChangeSongService::class, [
                'playlistId' => $request->playlistId,
                'user' => $user,
                'currentSongId' => $request->get('song_id'),
                'playlistSong' => $playlistSong,
                'playlist' => $playlist
            ]);


            event(new AutoSongChanged($songPlayingService));

            return $response;
        } catch (ResponseableException $exception) {
            $response->fail($exception->getResponseMessage());

            return $response;
        }
    }


}
