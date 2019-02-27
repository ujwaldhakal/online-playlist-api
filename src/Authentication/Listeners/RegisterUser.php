<?php

namespace OP\Authentication\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use OP\Authentication\Entities\UserInterface;
use OP\Authentication\Events\UserRegistered;

class RegisterUser
{
    private $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function handle(UserRegistered $event)
    {
        return $this->user->create($event->getService());
    }


}
