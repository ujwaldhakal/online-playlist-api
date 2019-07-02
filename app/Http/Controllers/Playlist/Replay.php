<?php

namespace App\Http\Controllers\Playlist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Lumen\Application;
use OP\Authentication\Entities\LoggedInUser;
use OP\Playlist\Entities\PlaylistInterface;
use OP\Playlist\Events\PlaylistReplayed;
use OP\Playlist\Events\SongAdded;
use OP\Playlist\Services\AddSongService;
use OP\Playlist\Services\ReplayService;
use OP\Services\Exceptions\ResponseableException;
use OP\Services\Response\ApiResponse;
use OP\Services\Transformers\CollectionTransformer;

class Replay extends Controller
{
    public function __invoke(Application $application, Request $request, ApiResponse $response, LoggedInUser $user, PlaylistInterface $playlist)
    {
        try {
            $replayService = $application->make(ReplayService::class, [
                'playlistId' => $request->id,
                'user' => $user,
                'playlist' => $playlist
            ]);


            event(new PlaylistReplayed($replayService));

            return $response->respondWithItem([], new CollectionTransformer());
        } catch (ResponseableException $exception) {
            $response->fail($exception->getResponseMessage());

            return $response;
        }
    }

}
