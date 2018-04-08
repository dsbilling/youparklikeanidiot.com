<?php namespace LANMS\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

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
			return redirect()->route('home')
						->with('messagetype', 'info')
						->with('message', 'You do not have access to this page while your are logged in!');
		}

		return $next($request);
	}

}
