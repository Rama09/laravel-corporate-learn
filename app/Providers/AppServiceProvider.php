<?php

namespace Corp\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // @set($i,10)
        \Blade::directive('set', function($exp){
            list($name, $val) = explode(',', $exp);

            return "<?php $name = $val?>";
        });

//        \DB::listen(function($query){
//            dump(['sql' => $query->sql, 'time' => $query->time]);
//        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
