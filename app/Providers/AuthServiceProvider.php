<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Bike' => 'App\Policies\BikePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //traducción del email de validación
        VerifyEmail::toMailUsing(function($notifiable, $url){
            return (new MailMessage)
                ->subject('Verificar email')
                ->greeting('Hola')
                ->salutation('Un saludo')
                ->line('Haz cliec en la siguiete línea para verificar tu email.')
                ->action('Verificar email', $url);
        });

        /**
         * GATE para autorizar el borrado de una moto.
         * Ejemplo solo pra pruebas de gate:
         *  Gate::define('borrarMoto', function($user, $bike){
         *       return $user->id == $bike->user_id;
         * });
         */
    }
}
