<?php

namespace App\Http\Controllers\Playlist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Lumen\Application;
use OP\Authentication\Entities\LoggedInUser;
use OP\Playlist\Entities\PlaylistInterface;
use OP\Playlist\Events\PlaylistCreated;
use OP\Playlist\Services\PlaylistCreationService;
use OP\Services\Response\ApiResponse;
use OP\Services\Exceptions\ResponseableException;
use OP\Services\Transformers\CollectionTransformer;

class CreatePlaylist extends Controller
{
    public function __invoke(Application $application, Request $request, ApiResponse $response, LoggedInUser $user, PlaylistInterface $playlist)
    {
        try {
            $this->runRequestValidation($request);
            $playlistCreatonService = $application->make(PlaylistCreationService::class, [
                'formData' => $request->all(),
                'user' => $user,
                'playlist' => $playlist
            ]);


            event(new PlaylistCreated($playlistCreatonService));

            return $response->respondWithItem($playlistCreatonService->extract(), new CollectionTransformer());
        } catch (ResponseableException $exception) {
            $response->fail($exception->getResponseMessage());

            return $response;
        }
    }

    private function runRequestValidation($request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
    }
}
