<?php

namespace App\Providers;

use App\Models\Proyecto;
use App\Models\User;
use App\Policies\ProyectoPolicy;
use App\Services\CiclosPorFamiliaService;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CiclosPorFamiliaService::class, function () {
            return new CiclosPorFamiliaService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url') . "/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        Gate::policy(Proyecto::class, ProyectoPolicy::class);
        Gate::define('gestionar-proyectos', function (User $user) {
            return $user->docente && $user->name === env('ADMIN_USER');

          /*   Gate::before(function (User $user, string $ability) {
                if ($user->name === env('ADMIN_USER')) {
                    return true;
                }

                return null;
            }); */
        });

        Gate::define('gestionar-estudiantes', function (User $user) {
            return $user->estudiante !== null;
        });
    }
}
