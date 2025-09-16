<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Mail;
use Aws\Ses\SesClient;
use Illuminate\Mail\Transport\SesTransport;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(SesClient::class, function () {
            $key = env('AWS_ACCESS_KEY_ID');
            $secret = env('AWS_SECRET_ACCESS_KEY');

            if (!$key || !$secret) {
                throw new \RuntimeException('AWS credentials missing.');
            }

            return new SesClient([
                'version'     => 'latest',
                'region'      => env('AWS_DEFAULT_REGION', 'ap-northeast-1'),
                'credentials' => [
                    'key'    => $key,
                    'secret' => $secret,
                ],
            ]);
        });
    }

    public function boot()
    {
        Mail::extend('ses', function () {
            return new SesTransport($this->app->make(SesClient::class));
        });
    }
}
