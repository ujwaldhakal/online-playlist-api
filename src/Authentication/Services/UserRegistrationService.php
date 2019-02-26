<?php

namespace OP\Authentication\Services;

use Illuminate\Support\Collection;
use OP\Authentication\Entities\UserInterface;
use OP\Authentication\Exceptions\EmailAlreadyTaken;
use OP\Services\Write\CreateInterface;

class UserRegistrationService implements CreateInterface
{
    private $formData;
    private $id;
    private $user;

    public function __construct($formData, UserInterface $user)
    {
        $this->user = $user;
        $this->formData = new Collection($formData);
        $this->id = getUuid();
        $this->runDataValidation();
    }

    private function runDataValidation()
    {
        $this->checkIfEmailAlreadyExists();
    }

    private function checkIfEmailAlreadyExists()
    {
        if ($this->user->findByEmail($this->formData->get('email'))) {
            throw new EmailAlreadyTaken();
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function extract(): array
    {
        return [
            'email' => $this->formData->get('email'),
            'password' => $this->formData->get('password')
        ];
    }
}
