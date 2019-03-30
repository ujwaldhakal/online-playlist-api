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
    private $domains = [
        'Authentication',
        'Room',
        'Playlist'
    ];


    public function register()
    {
        $this->registerRoutes();
    }

    private function registerRoutes()
    {
        foreach ($this->domains as $domain) {
            $class = "\\OP\\{$domain}\\Resolver\\Routes";
            $class = new $class($this->app);
            $class->registerRoutes();
        }
    }

}
