<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Service;
use App\Policies\ServicePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    
    protected $policies = [
        
    ];

    
    public function boot(): void
    {
        
    }
}
