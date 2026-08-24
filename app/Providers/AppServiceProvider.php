<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Mail;
use Aws\Ses\SesClient;
use Illuminate\Mail\Transport\SesTransport;
use RuntimeException;

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
        Mail::extend('ses', function() {
            $key = config('services.ses.key');
            $secret = config('services.ses.secret');

            if (empty($key) || empty($secret)) {
                throw new RuntimeException('AWS SES credentials are not configured. Set AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY in .env.');
            }

            $sesClient = new SesClient([
                'version' => 'latest',
                'region'  => config('services.ses.region', 'ap-northeast-1'),
                'credentials' => [
                    'key'    => $key,
                    'secret' => $secret,
                ],
            ]);

            return new SesTransport($sesClient);
        });
    }
}
