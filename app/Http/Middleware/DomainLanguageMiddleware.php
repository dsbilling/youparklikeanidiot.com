<?php

namespace DPSEI\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class DomainLanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $url_array = explode('.', parse_url($request->url(), PHP_URL_HOST));
        $tld = $url_array[1];

        $tlds = [
            'no' => 'nb',
            'com' => 'en'
        ];

        if (array_key_exists($tld, $tlds)) {
            App::setLocale($tlds[$tld]);
        }

        return $next($request);
    }
}
