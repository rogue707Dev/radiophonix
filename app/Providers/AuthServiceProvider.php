<?php

namespace Radiophonix\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Radiophonix\Models\Saga;
use Radiophonix\Policies\SagaPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Saga::class => SagaPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        ResetPassword::toMailUsing(function ($notifiable, $token) {
            $url = route(
                'password-reset',
                [
                    'token' => $token,
                    'email' => $notifiable->email,
                ]
            );

            return (new MailMessage)
                ->subject('Réinitialiser le mot de passe')
                ->line('Vous recevez cet email car nous avons reçu une demande de réinitialisation de votre mot de passe')
                ->action('Réinitialiser le mot de passe', $url)
                ->line('Si vous n\'êtes pas à l\'origine de cette demande de réinitialisation, vous pouvez l\'ignorer.');
        });
    }
}
