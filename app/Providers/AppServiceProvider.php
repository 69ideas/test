<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use PayPal\Core\PPHttpConfig;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        PPHttpConfig::$DEFAULT_CURL_OPTS = array(
            CURLOPT_SSLVERSION => 1,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_TIMEOUT        => 60,   // maximum number of seconds to allow cURL functions to execute
            CURLOPT_USERAGENT      => 'PayPal-PHP-SDK',
            CURLOPT_HTTPHEADER     => array(),
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_SSL_VERIFYPEER => 1,
            CURLOPT_SSL_CIPHER_LIST => 'TLSv1',
        );
    }
}
