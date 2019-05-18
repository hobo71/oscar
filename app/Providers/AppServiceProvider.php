<?php

namespace Camino\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    
    public function boot() {
        date_default_timezone_set('America/Argentina/Ushuaia');
        \Carbon\Carbon::setLocale('es');
        setlocale(LC_TIME, 'es_ES');

        // view()->composer('*',function($view) {
        //     $view->with('carbon_ahora',  Carbon::now() );
        //     $view->with('carbon_hoy',  Carbon::today() );
        // });

        date_default_timezone_set('America/Argentina/Ushuaia');
        setlocale(LC_TIME, 'Argentina');
        setlocale(LC_MONETARY, 'es_AR');


        setlocale(LC_TIME, 'es_ES');
        \Carbon\Carbon::setLocale('es');
    }

    public function register() {
    }
}
