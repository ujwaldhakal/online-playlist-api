<?php

namespace App\Http\Controllers\Playlist;

use Illuminate\Http\Request;
use Laravel\Lumen\Application;
use OP\Authentication\Entities\LoggedInUser;
use OP\Room\Entities\RoomInterface;
use OP\Services\Response\ApiResponse;
use OP\Services\Exceptions\ResponseableException;

class CreatePlaylist
{
    public function __invoke(Application $application, Request $request, ApiResponse $response, LoggedInUser $user, RoomInterface $room)
    {
        try {

            $this->runRequestValidation($request);
            $roomCreationService = $application->make(RoomCreationService::class, [
                'formData' => $request->all(),
                'user' => $user,
                'room' => $room
            ]);

            event(new RoomCreated($roomCreationService));

            return $response->respondWithItem($roomCreationService->extract(), new CollectionTransformer());
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
