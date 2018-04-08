<?php
namespace LANMS\Http\Controllers\Admin;

use LANMS\Http\Requests;
use LANMS\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

use LANMS\Http\Requests\Admin\LicenseKeyEditRequest;

class LicenseController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Sentinel::getUser()->hasAccess(['admin.license.*'])) {
			return view('license.index');
		} else {
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}

	public function check()
	{
		if (Sentinel::getUser()->hasAccess(['admin.license.*'])) {
			\Artisan::call('lanms:checklicense');
			return Redirect::route('admin-license')->with('messagetype', 'success')
								->with('message', 'License status updated!');
		} else {
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}

	public function store(LicenseKeyEditRequest $request)
	{
		if (Sentinel::getUser()->hasAccess(['admin.license.*'])) {
			if(is_null($request->licensekey)) {
				$licensekey = "";
			} else {
				$licensekey = $request->licensekey;
			}
			\Setting::set('APP_LICENSE_KEY', $licensekey);
			\Setting::save();
			\Artisan::call('lanms:checklicense');
			return Redirect::route('admin-license')->with('messagetype', 'success')
								->with('message', 'License key and status updated!');
		} else {
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}

}
