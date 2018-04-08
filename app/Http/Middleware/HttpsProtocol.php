<?php namespace LANMS\Http\Middleware;

use Closure;

use anlutro\LaravelSettings\Facade as Setting;

class HttpsProtocol {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if(\Schema::hasTable('settings')) {
			if (!$request->secure() && Setting::get('WEB_PROTOCOL') === 'https') {
				return redirect()->secure($request->getRequestUri());
			} 
		}

		return $next($request); 
	}

}
