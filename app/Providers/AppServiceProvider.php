<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Rules\MatchOldPassword;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot()
    {
        Validator::extend('current_password', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value, auth()->user()->password);
        });
        Validator::extend('match_old_password', MatchOldPassword::class);
    }
}
