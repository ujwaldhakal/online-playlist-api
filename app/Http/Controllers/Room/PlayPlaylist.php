<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Lumen\Application;
use OP\Authentication\Entities\LoggedInUser;
use OP\Playlist\Entities\PlaylistInterface;
use OP\Room\Entities\RoomInterface;
use OP\Room\Events\PlaylistPlayed;
use OP\Room\Events\RoomCreated;
use OP\Services\Response\ApiResponse;
use OP\Services\Exceptions\ResponseableException;
use OP\Services\Transformers\CollectionTransformer;
use OP\Room\Services\PlayPlaylist as PlayPlaylistService;

class PlayPlaylist extends Controller
{
    public function __invoke(Application $application, Request $request, ApiResponse $response, LoggedInUser $user, PlaylistInterface $playlist, RoomInterface $room)
    {
        try {
            $playPlaylistService = $application->make(PlayPlaylistService::class, [
                'roomId' => $request->roomId,
                'playlistId' => $request->playlistId,
                'user' => $user,
                'room' => $room,
                'playlist' => $playlist,
            ]);

            event(new PlaylistPlayed($playPlaylistService));

            return $response;

        } catch (ResponseableException $exception) {
            $response->fail($exception->getResponseMessage());

            return $response;
        }
    }

}
