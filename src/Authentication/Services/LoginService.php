<?php

namespace OP\Authentication\Services;

use Ep\Authentication\Entities\User;
use Ep\Authentication\Exceptions\LoginFailedException;
use Ep\Authentication\Exceptions\TeamDoesnotExists;
use Ep\Authentication\Exceptions\UserNotVerifiedException;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Collection;
use OP\Authentication\Entities\UserInterface;
use OP\Authentication\Exceptions\LoginFailed;
use OP\Authentication\Exceptions\UserNotVerified;
use OP\Services\Auth\AuthInterface;
use Tymon\JWTAuth\JWTAuth;

class LoginService
{
    private $token;
    private $auth;
    private $user;
    private $formData;

    public function __construct(AuthInterface $auth, $formData, UserInterface $user)
    {
        $this->formData = new Collection($formData);
        $this->auth = $auth;
        $this->token = $this->auth->attempt([
            'email' => $this->formData->get('email'),
            'password' => $this->formData->get('password')]);

        $this->user = $user->findByEmail($this->formData->get('email'));
        $this->runDataValidation();
    }

    private function runDataValidation()
    {
        $this->checkIfEmailIsVerified();
    }

    private function checkIfEmailIsVerified()
    {
        if ($this->user && !$this->user->isVerified()) {
            throw new UserNotVerified();
        }

        if (!$this->token) {
            throw new LoginFailed();
        }
    }

    public function extract(): array
    {
        return [
            'access_token' => $this->token,
            'token_type' => 'bearer',
            'expires_in' => $this->auth->factory()->getTTL() * 60,
        ];
    }

    private function verifyProcessableData()
    {
        if (!$this->user->isVerified()) {
            throw new UserNotVerifiedException();
        }

        if (!$this->token) {
            throw new LoginFailedException();
        }
    }

    public function getToken(): array
    {
        return [
            'access_token' => $this->token,
            'token_type' => 'bearer',
            'expires_in' => $this->auth->getTokenExpiry(),
        ];
    }

    public function getLoggedInUserId(): ?string
    {

        return $this->auth->user()->id;
    }
}
