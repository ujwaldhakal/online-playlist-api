<?php

namespace App\Providers;

use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\ServiceProvider;
use OP\Services\Read\Connection\ReadConnection;

class AppServiceProvider extends ServiceProvider
{
    private $domains = [
        'Authentication',
        'Room',
        'Playlist'
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->bindCustomClasses();
        $this->bindDataConnection();
    }

    public function bindDataConnection()
    {
        $this->app->singleton(ConnectionInterface::class, function () {
            return app('db')->connection();
        });
    }

    private function bindCustomClasses()
    {
        foreach ($this->domains as $domain) {
            $class = "\\OP\\{$domain}\\Resolver\\BindClass";
            $class = new $class($this->app);
            $class->bind();
        }
    }
}
