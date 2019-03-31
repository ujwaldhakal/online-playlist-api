<?php

namespace App\Http\Controllers\Playlist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Lumen\Application;
use OP\Authentication\Entities\LoggedInUser;
use OP\Playlist\Entities\PlaylistInterface;
use OP\Playlist\Events\PlaylistCreated;
use OP\Playlist\Events\PlaylistDeleted;
use OP\Playlist\Services\PlaylistCreationService;
use OP\Playlist\Services\PlaylistDeletionService;
use OP\Services\Response\ApiResponse;
use OP\Services\Exceptions\ResponseableException;
use OP\Services\Transformers\CollectionTransformer;

class DeletePlaylist extends Controller
{
    public function __invoke(Application $application, Request $request, ApiResponse $response, LoggedInUser $user, PlaylistInterface $playlist)
    {
        try {
            $playlistDeletionService = $application->make(PlaylistDeletionService::class, [
                'id' => $request->id,
                'user' => $user,
                'playlist' => $playlist
            ]);


            event(new PlaylistDeleted($playlistDeletionService));


            return $response;
        } catch (ResponseableException $exception) {
            $response->fail($exception->getResponseMessage());

            return $response;
        }
    }
}
