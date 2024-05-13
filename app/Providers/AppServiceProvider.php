<?php

namespace App\Providers;

use App\Models\analyze;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Timetable;
use App\Policies\AnalyzePolicy;
use App\Policies\DoctorPolicy;
use App\Policies\ServicePolicy;
use App\Policies\TimetablePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::policy(Service::class, ServicePolicy::class);
        Gate::policy(Doctor::class, DoctorPolicy::class);
        Gate::policy(Timetable::class, TimetablePolicy::class);
        Gate::policy(analyze::class, AnalyzePolicy::class);
    }
}
