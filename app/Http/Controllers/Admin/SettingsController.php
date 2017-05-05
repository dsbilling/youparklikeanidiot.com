<?php namespace DPSEI\Http\Controllers\Admin;

use DPSEI\Http\Requests;
use DPSEI\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use anlutro\LaravelSettings\Facade as Setting;
use Illuminate\Support\Facades\Redirect;

use DPSEI\Http\Requests\Admin\SettingEditRequest;

class SettingsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Sentinel::getUser()->hasAccess(['admin.settings.*'])){
			$settings = Setting::all();
			$removesettings = array_splice($settings, 0, 4);
			return view('settings.index')
						->withSettings($settings);
		} else {
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if (Sentinel::getUser()->hasAccess(['admin.settings.update'])){
			$value = Setting::get($id);
			return view('settings.edit')
						->withKey($id)->withvalue($value);
		} else {
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, SettingEditRequest $request)
	{
		if (Sentinel::getUser()->hasAccess(['admin.settings.update'])){
			Setting::set($id, $request->value);
			Setting::save();
			return Redirect::route('admin-settings')
					->with('messagetype', 'success')
					->with('message', 'The setting has now been saved!');

		} else {
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}

}
