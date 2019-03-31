<?php

namespace App\Http\Controllers\Playlist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Lumen\Application;
use OP\Authentication\Entities\LoggedInUser;
use OP\Playlist\Entities\PlaylistSongInterface;
use OP\Playlist\Events\SongRemoved;
use OP\Playlist\Services\RemoveSongService;
use OP\Services\Response\ApiResponse;
use OP\Services\Exceptions\ResponseableException;

class RemoveSong
{
    public function __invoke(Application $application, Request $request, ApiResponse $response, LoggedInUser $user, PlaylistSongInterface $playlistSong)
    {
        try {
            $songRemoveService = $application->make(RemoveSongService::class, [
                'id' => $request->songId,
                'user' => $user,
                'playlistSong' => $playlistSong
            ]);

            event(new SongRemoved($songRemoveService));

            return $response;
        } catch (ResponseableException $exception) {
            $response->fail($exception->getResponseMessage());

            return $response;
        }
    }
}
