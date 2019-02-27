<?php

namespace App\Http\Controllers\Authentication;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Lumen\Application;
use OP\Authentication\Services\LoginService;
use OP\Services\Auth\AuthInterface;
use OP\Services\Response\ApiResponse;
use OP\Services\Exceptions\ResponseableException;
use OP\Services\Transformers\CollectionTransformer;

class Login extends Controller
{
    public function __invoke(Application $application, Request $request, ApiResponse $response, AuthInterface $auth)
    {
        try {
            $this->runRequestValidation($request);
            $registrationService = $application->make(LoginService::class, [
                'formData' => $request->all(),
                'auth' => $auth
            ]);


            return $response->respondWithItem($registrationService->extract(), new CollectionTransformer());

        } catch (ResponseableException $exception) {
            $response->fail($exception->getResponseMessage());

            return $response;
        }
    }

    private function runRequestValidation($request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

    }
}
