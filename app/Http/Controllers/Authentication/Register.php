<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Lumen\Application;
use OP\Authentication\Events\UserRegistered;
use OP\Authentication\Services\UserRegistrationService;
use OP\Services\Exceptions\ResponseableException;
use OP\Services\Response\ApiResponse;

class Register extends Controller
{
    public function __invoke(Application $application, Request $request, ApiResponse $response)
    {
        try {
            $this->runRequestValidation($request);
            $registrationService = $application->make(UserRegistrationService::class, [
                'formData' => $request->all()
            ]);

            event(new UserRegistered($registrationService));

            return $response;

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
