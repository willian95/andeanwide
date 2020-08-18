<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Mail\EmailVerification;
use Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Blade::directive('print_status', function($status) {
            return "
                <?php
                    if($status == 'incompleted') {
                        echo '<span class=\"badge badge-warning\" title=\"Solicitud incompleta por el usuario.\">Solicitud Incompleta</span>';
                    } else if($status == 'pending_payment') {
                        echo '<span class=\"badge badge-warning\" title=\"Solicitud completa y pendiente por pago.\">Pendiente Por Pago</span>';
                    } else if($status == 'upload_payment') {
                        echo '<span class=\"badge badge-success\" title=\"Pago realizado, pendiente por verificación.\">Pago Realizado</span>';
                    } else if($status == 'verified') {
                        echo '<span class=\"badge badge-success\" title=\"Pago verificado.\">Pago Verificado</span>';
                    } else if($status == 'rejected') {
                        echo '<span class=\"badge badge-danger\" title=\"Orden rechazada.\">Orden Rechazada</span>';
                    } else if($status == 'expired') {
                        echo '<span class=\"badge badge-danger\" title=\"Orden expirada.\">Orden Expiró</span>';
                    } else if($status == 'completed') {
                        echo '<span class=\"badge badge-success\" title=\"Orden completada.\">Orden Completada</span>';
                    }
                ?>
            ";
        });
    }
}
