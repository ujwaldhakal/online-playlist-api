<?php

namespace OP\Authentication\Resolver;

class BindClass
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function bind()
    {
//        $this->app->bind(LoggedInUser::class, function () {
//            return new User(auth()->user());
//        });
    }
}
