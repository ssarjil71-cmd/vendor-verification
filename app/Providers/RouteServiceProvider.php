<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     */
    public function map(): void
    {
        $this->mapWebRoutes();
        $this->mapApiRoutes();
        $this->mapAdminRoutes();
        $this->mapCompanyRoutes();
        $this->mapVendorRoutes();
    }

    protected function mapWebRoutes(): void
    {
        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    }

    protected function mapApiRoutes(): void
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php'));
    }

    protected function mapAdminRoutes(): void
    {
        Route::prefix('admin')
            ->middleware('web')
            ->name('admin.')
            ->group(base_path('routes/admin.php'));
    }

    protected function mapCompanyRoutes(): void
    {
        Route::prefix('company')
            ->middleware('web')
            ->name('company.')
            ->group(base_path('routes/company.php'));
    }

    protected function mapVendorRoutes(): void
    {
        Route::prefix('vendor')
            ->middleware('web')
            ->name('vendor.')
            ->group(base_path('routes/vendor.php'));
    }
}
