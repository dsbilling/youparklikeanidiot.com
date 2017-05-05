<?php namespace DPSEI\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Redirect;

class SentinelGuest {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

		if (Sentinel::check())
		{
			return Redirect::route('home')
						->with('messagetype', 'info')
						->with('message', 'You do not have access to this page while your are logged in!');
		}

		return $next($request);
	}

}
