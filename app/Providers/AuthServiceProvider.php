<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Illuminate\Mail\MailManager;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Mail\Mailables\Attachment;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */

    public function boot()
    {
        $this->registerPolicies();



        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            // $logoPath = Storage::url('unnamed_(2).png');

            

            return (new MailMessage)
                ->view('Mails.verify',  ['url' => $url, "user" => $notifiable, "logoPath" => Storage::url('unnamed_(2).png')]);
                // ->attach(public_path(Storage::url('unnamed_(2).png')), [
                //     'as' => 'logo.png',
                //     'mime' => 'image/png',
                // ]);
        });
    }
}
