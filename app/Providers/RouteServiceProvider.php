<?php

namespace App\Providers;


use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends AppServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */

    public function register()
    {
        $this->mapAuthRoutes();
    }

    private function mapAuthRoutes()
    {
        $this->app->router->group([
            'namespace' => 'App\Http\Controllers',
        ], function ($router) {
            require base_path('routes/auth.php');
        });
    }
}
