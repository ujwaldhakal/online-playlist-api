<?php

namespace App\Http\Controllers\Room;

use Illuminate\Database\ConnectionInterface;
use Illuminate\Http\Request;
use Laravel\Lumen\Application;
use OP\Authentication\Entities\LoggedInUser;
use OP\Room\Queries\FetchCurrentPlaying;
use OP\Room\Queries\FetchRooms;
use OP\Room\Queries\Filters\FetchRoomsFilter;
use OP\Services\Read\Connection\ReadConnection;
use OP\Services\Response\ApiResponse;
use OP\Services\Exceptions\ResponseableException;
use OP\Services\Transformers\CollectionTransformer;

class CurrentPlaying
{
    public function __invoke(Application $application, Request $request, ApiResponse $response, LoggedInUser $user, ConnectionInterface $connection)
    {
        try {

            $query = $application->make(FetchCurrentPlaying::class, [
                'connection' => $connection,
                'roomId' => $request->roomId
            ]);

            return $response->respondWithCollection($query, new CollectionTransformer());

        } catch (ResponseableException $exception) {
            $response->fail($exception->getResponseMessage());

            return $response;
        }

    }
}
