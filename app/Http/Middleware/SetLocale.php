<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check for locale in header, then in query parameter, then use default
        $locale = $request->header('Accept-Language') 
                 ?: $request->query('lang')
                 ?: config('app.locale');
        
        // Validate the locale against supported locales
        if (in_array($locale, config('app.available_locales', ['en', 'ar']))) {
            app()->setLocale($locale);
        } else {
            // Fallback to the default locale if the requested one is not supported
            app()->setLocale(config('app.fallback_locale', 'en'));
        }
        
        // Add the current locale to the response headers
        $response = $next($request);
        $response->headers->set('Content-Language', app()->getLocale());
        
        return $response;
    }
}
