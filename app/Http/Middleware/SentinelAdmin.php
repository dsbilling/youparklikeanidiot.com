<?php namespace LANMS\Http\Middleware;

use Closure;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class SentinelAdmin {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		// First make sure there is an active session
		if (!Sentinel::check()) {
			if ($request->ajax()) {
				return response('Unauthorized.', 401);
			} else {
				return redirect()->back()->with('messagetype', 'info')
										->with('message', 'You need to login to access this page!');
			}
		}
		// Now check to see if the current user has the 'admin' permission
		if (!Sentinel::getUser()->hasAccess('admin')) {
			if ($request->ajax()) {
				return response('Unauthorized.', 401);
			} else {
				return redirect()->back()->with('messagetype', 'warning')
										->with('message', 'You do not have access to this page!');
			}
		}
		// All clear - we are good to move forward
		return $next($request);
	}

}
