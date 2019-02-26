<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Lumen\Application;
use OP\Authentication\Services\UserRegistrationService;
use OP\Services\Exceptions\ResponseableException;

class Register extends Controller
{
    public function __invoke(Application $application, Request $request)
    {
        try {
            $this->runRequestValidation($request);
            $registrationService = $application->make(UserRegistrationService::class, [
                'formData' => $request->all()
            ]);
        } catch (ResponseableException $exception) {

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
