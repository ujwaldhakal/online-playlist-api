<?php

namespace App\Http\Controllers\Playlist;

use Illuminate\Database\ConnectionInterface;
use Illuminate\Http\Request;
use Laravel\Lumen\Application;
use OP\Authentication\Entities\LoggedInUser;
use OP\Playlist\Queries\FetchPlaylist as FetchPlaylistQuery;
use OP\Playlist\Queries\Filters\FetchPlaylistFilter;
use OP\Playlist\Queries\Filters\FetchSongFilter;
use OP\Services\Read\Connection\ReadConnection;
use OP\Services\Response\ApiResponse;
use OP\Services\Exceptions\ResponseableException;
use OP\Services\Transformers\CollectionTransformer;

class FetchSong
{
    public function __invoke(Application $application, Request $request, ApiResponse $response, LoggedInUser $user, ConnectionInterface $connection)
    {
        try {
            $filter = new FetchSongFilter($request->all());

            $query = $application->make(\OP\Playlist\Queries\FetchSong::class, [
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
