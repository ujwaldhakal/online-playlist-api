<?php

namespace App\Http\Controllers\Playlist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Lumen\Application;
use OP\Authentication\Entities\LoggedInUser;
use OP\Playlist\Entities\PlaylistInterface;
use OP\Playlist\Entities\PlaylistSongInterface;
use OP\Playlist\Events\PlaylistCreated;
use OP\Playlist\Events\SongAdded;
use OP\Playlist\Events\SongPlayed;
use OP\Playlist\Services\AddSongService;
use OP\Playlist\Services\CurrentPlayingService;
use OP\Playlist\Services\PlaylistCreationService;
use OP\Services\Response\ApiResponse;
use OP\Services\Exceptions\ResponseableException;
use OP\Services\Transformers\CollectionTransformer;

class PlaySong
{
    public function __invoke(Application $application, Request $request, ApiResponse $response, LoggedInUser $user, PlaylistSongInterface $playlistSong)
    {
        try {
            $songPlayingService = $application->make(CurrentPlayingService::class, [
                'songId' => $request->songId,
                'user' => $user,
                'playlistSong' => $playlistSong
            ]);


            event(new SongPlayed($songPlayingService));

            return $response;
        } catch (ResponseableException $exception) {
            $response->fail($exception->getResponseMessage());

            return $response;
        }
    }


}
