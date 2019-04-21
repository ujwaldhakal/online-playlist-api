<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Lumen\Application;
use OP\Authentication\Entities\LoggedInUser;
use OP\Authentication\Services\LoginService;
use OP\Services\Auth\AuthInterface;
use OP\Services\Response\ApiResponse;
use OP\Services\Exceptions\ResponseableException;
use OP\Services\Transformers\CollectionTransformer;
use OP\User\Queries\FetchLoggedInUserInfo;
use OP\User\Queries\Filters\FetchLoggedInUserInfo as FetchLoggedInUserInfoFilter;
use Illuminate\Database\ConnectionInterface;

class GetInfo extends Controller
{
    public function __invoke(Application $application, Request $request, ApiResponse $response, LoggedInUser $user, ConnectionInterface $connection)
    {
        try {
            $fiilter = new FetchLoggedInUserInfoFilter($request->all());
            $query = $application->make(FetchLoggedInUserInfo::class, [
                'filter' => $fiilter,
                'connection' => $connection,
                'user' => $user
            ]);


            return $response->respondWithCollection($query, new CollectionTransformer());

        } catch (ResponseableException $exception) {
            $response->fail($exception->getResponseMessage());

            return $response;
        }
    }


}
