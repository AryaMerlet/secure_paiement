<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Paiement;
use App\Policies\PaiementPolicy;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Summary of policies
     * @var array
     */
    protected $policies = [
        Paiement::class => PaiementPolicy::class,
    ];

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
        //
    }
}
