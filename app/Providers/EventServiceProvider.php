<?php

namespace App\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [

    ];

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
        $this->registerEvents();
    }

    private function registerEvents()
    {
        foreach ($this->domains as $domain) {
            $class = "\\OP\\{$domain}\\Resolver\\EventRegistar";
            $this->listen = array_merge($this->listen, $class::getRegisteredEvents());
        }
    }

}
