<?php namespace DPSEI\Http\Controllers\Admin;

use DPSEI\Http\Controllers\Controller;

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
