<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session as FacadesSession;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the locale is provided in the query string or header
        $locale = $request->query('locale') ?? $request->header('Accept-Language') ?? 'ru';

        // Set the application locale
        App::setLocale($locale);
        FacadesSession::put('locale', $locale);


        // Debugging statement to log the request data
        Log::info('Request data: ', $request->all());

        return $next($request);
    }
}
