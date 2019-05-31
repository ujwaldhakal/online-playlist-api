<?php

namespace App\Http\Controllers\Room;

use Illuminate\Database\ConnectionInterface;
use Illuminate\Http\Request;
use Laravel\Lumen\Application;
use OP\Authentication\Entities\LoggedInUser;
use OP\Playlist\Entities\PlaylistSong;
use OP\Room\Entities\RoomInterface;
use OP\Room\Events\SongAddedToDefaultPlaylist;
use OP\Room\Services\AddSongToCurrentlyPlayingPlaylistService;
use OP\Services\Response\ApiResponse;

class AddSongToCurrentlyPlayingPlaylist
{
    public function __invoke(Application $application, Request $request, ApiResponse $response, LoggedInUser $user,
                             ConnectionInterface $connection, PlaylistSong $playlistSong, RoomInterface $room)
    {
        try {

            $service = $application->make(AddSongToCurrentlyPlayingPlaylistService::class, [
                'roomId' => $request->roomId,
                'playlistSong' => $playlistSong,
                'songLink' => $request->get('song_link'),
                'room' => $room,
                'user' => $user
            ]);

            event(new SongAddedToDefaultPlaylist($service));
//            return $response->respondWithCollection($query, new CollectionTransformer());

        } catch (ResponseableException $exception) {
            $response->fail($exception->getResponseMessage());

            return $response;
        }

    }
}
