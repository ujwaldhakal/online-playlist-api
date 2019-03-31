<?php

namespace App\Http\Controllers\Playlist;

use Illuminate\Database\ConnectionInterface;
use Illuminate\Http\Request;
use Laravel\Lumen\Application;
use OP\Authentication\Entities\LoggedInUser;
use OP\Playlist\Queries\FetchPlaylist as FetchPlaylistQuery;
use OP\Playlist\Queries\Filters\FetchPlaylistFilter;
use OP\Services\Read\Connection\ReadConnection;
use OP\Services\Response\ApiResponse;
use OP\Services\Exceptions\ResponseableException;
use OP\Services\Transformers\CollectionTransformer;

class FetchPlaylist
{
    public function __invoke(Application $application, Request $request, ApiResponse $response, LoggedInUser $user, ConnectionInterface $connection)
    {
        try {
            $filter = new FetchPlaylistFilter($request->all());

            $query = $application->make(FetchPlaylistQuery::class, [
                'connection' => $connection,
                'filter' => $filter
            ]);

            return $response->respondWithCollection($query, new CollectionTransformer());

        } catch (ResponseableException $exception) {
            $response->fail($exception->getResponseMessage());

            return $response;
        }

    }
}
