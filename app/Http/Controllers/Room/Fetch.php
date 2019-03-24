<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use Illuminate\Database\Connection;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Http\Request;
use Laravel\Lumen\Application;
use OP\Authentication\Entities\LoggedInUser;
use OP\Authentication\Services\LoginService;
use OP\Room\Entities\RoomInterface;
use OP\Room\Events\RoomCreated;
use OP\Room\Queries\FetchRooms;
use OP\Room\Queries\Filters\FetchRoomsFilter;
use OP\Room\Services\RoomCreationService;
use OP\Services\Auth\AuthInterface;
use OP\Services\Read\Connection\ReadConnection;
use OP\Services\Response\ApiResponse;
use OP\Services\Exceptions\ResponseableException;
use OP\Services\Transformers\CollectionTransformer;

class Fetch
{
    public function __invoke(Application $application, Request $request, ApiResponse $response, LoggedInUser $user, ConnectionInterface $connection)
    {
        try {
            $filter = new FetchRoomsFilter($request->all());

            $query = $application->make(FetchRooms::class, [
                'filter' => $filter,
                'connection' => $connection
            ]);

            return $response->respondWithCollection($query, new CollectionTransformer());

        } catch (ResponseableException $exception) {
            $response->fail($exception->getResponseMessage());

            return $response;
        }

    }
}
