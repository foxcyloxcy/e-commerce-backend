<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Mail;
use Aws\Ses\SesClient;
use Illuminate\Mail\Transport\SesTransport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $sesClient = new SesClient([
            'version' => 'latest',
            'region'  => 'ap-northeast-1', // Explicitly force Tokyo region for SES
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);
    
        Mail::extend('ses', function() use ($sesClient) {
            return new SesTransport($sesClient);
        });
    }
}
