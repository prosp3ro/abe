<?php

namespace App\Providers;

use App\Interfaces\BugReportServiceInterface;
use App\Services\BugReportService;
use Carbon\CarbonImmutable;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        BugReportServiceInterface::class => BugReportService::class
    ];

    // public $singletons = [
    //     BugReportServiceInterface::class => BugReportService::class
    // ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        // telescope
        // if ($this->app->environment("local") && class_exists(\Laravel\Telescope\TelescopeServiceProvider::class)) {
        //     $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
        // }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::defaultDenialResponse(Response::denyAsNotFound());
        $this->configureCommands();
        $this->configureModels();
        $this->configureDates();
        // $this->configureVite();
    }

    private function configureCommands(): void
    {
        DB::prohibitDestructiveCommands(
            $this->app->isProduction(),
        );
    }

    private function configureDates(): void
    {
        Date::use(CarbonImmutable::class);
    }

    private function configureModels(): void
    {
        // Model::unguard();
        Model::shouldBeStrict();
    }

    private function configureVite(): void
    {
        Vite::useAggressivePrefetching();
    }
}
