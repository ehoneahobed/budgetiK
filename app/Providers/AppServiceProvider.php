<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Currency;
use App\Models\Profile;
use Auth;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /* NOTE
            Middlewares are rendered long after service providers are rendered
            Hence, you can't directly use the Auth middleware in a serviceprovider
            For that matter, you have to put it within a view composer (which is only
            executed after the selected view is loaded)

        */
        view()->composer('*', function($view){
            if(Auth::user()){
                // get current user_id
                $user_id = Auth::user()->id;
                    //dd(Auth::user());
                //find the default currency_id set by current user
                $user_profile = Profile::where('user_id', $user_id)->first();
                $profile_currency_id = $user_profile->currency_id;

                //use the currency id to select all about that currency

                $active_currency = Currency::where('id', $profile_currency_id)->first();
                $currency_symbol = $active_currency->currency_symbol;
                $currency = $active_currency->currency_code;
                View::share('currency', $currency);
                View::share('currency_symbol', $currency_symbol);
        
            }
        });
        
        
        
    }
}
