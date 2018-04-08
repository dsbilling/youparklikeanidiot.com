<?php namespace LANMS\Http\Controllers\Admin;

use LANMS\Http\Controllers\Controller;

class AdminController extends Controller {

	public function dashboard()
	{
		return view('dashboard');
	}

	public function whatsnew()
	{
		return view('whatsnew');
	}

}
