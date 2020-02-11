<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Validator\CustomValidator;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //$attributes を引数に追加
        // \Validator::resolver(function ($translator, $data, $rules, $messages) {
        // return new CustomValidator($translator, $data, $rules, $messages);
        \Validator::resolver(function ($translator, $data, $rules, $messages, $attributes) {
            return new CustomValidator($translator, $data, $rules, $messages, $attributes);
        });
    }
}
