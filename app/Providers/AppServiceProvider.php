<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    private $domains = [
        'Authentication'
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
//        $this->app->singleton('environment', function () {
//            return new Environment();
//        });


        $this->bindCustomClasses();
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
