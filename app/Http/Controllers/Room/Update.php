<?php
/**
 * Created by PhpStorm.
 * User: anons
 * Date: 3/7/19
 * Time: 12:08 AM
 */

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Lumen\Application;
use OP\Authentication\Entities\LoggedInUser;
use OP\Authentication\Services\LoginService;
use OP\Room\Entities\RoomInterface;
use OP\Room\Events\RoomCreated;
use OP\Room\Events\RoomDeleted;
use OP\Room\Events\RoomUpdated;
use OP\Room\Services\RoomCreationService;
use OP\Room\Services\RoomDeletionService;
use OP\Room\Services\RoomUpdateService;
use OP\Services\Auth\AuthInterface;
use OP\Services\Response\ApiResponse;
use OP\Services\Exceptions\ResponseableException;
use OP\Services\Transformers\CollectionTransformer;

class Update extends Controller
{
    public function __invoke(Application $application, Request $request, ApiResponse $response, LoggedInUser $user, RoomInterface $room)
    {
        try {
            $roomUpdateService = $application->make(RoomUpdateService::class, [
                'formData' => $request->all(),
                'roomId' => $request->id,
                'user' => $user,
                'room' => $room
            ]);

            event(new RoomUpdated($roomUpdateService));

            return $response;

        } catch (ResponseableException $exception) {
            $response->fail($exception->getResponseMessage());

            return $response;
        }
    }

}
