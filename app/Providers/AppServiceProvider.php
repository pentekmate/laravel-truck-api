<?php

namespace App\Providers;

use App\Models\Site;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Policies\SitePolicy;
class AppServiceProvider extends ServiceProvider
{

    protected $policies = [
        Site::class => SitePolicy::class,
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
        Gate::policy(Site::class, SitePolicy::class);
    }
}
