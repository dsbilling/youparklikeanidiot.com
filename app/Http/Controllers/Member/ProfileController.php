<?php

namespace DPSEI\Http\Controllers\Member;

use DPSEI\Http\Controllers\Controller;
use DPSEI\User;

class ProfileController extends Controller {

	public function index($username) {
		$theuser = User::where('username', '=', $username)->first();
		if($theuser == null) {
			return abort(404); //if username does not exist
		}
		$onlinestatus = User::getOnlineStatus($theuser->id);
		$userarray = $theuser->toArray();
		$userarray['onlinestatus'] = $onlinestatus;
		$reservationscount = $theuser->reservations->count();
		return view('account.profile')->with($userarray)->with('reservationscount', $reservationscount);
	}

	public function getMembers() {
		$members = User::orderBy('username', 'asc')->paginate(10);
		$newestmembers = User::orderBy('created_at', 'desc')->take(4)->get();
		$onlinemembers = User::orderBy('last_activity', 'desc')->take(4)->get();
		
		return view('account.members')
				->with('members', $members)
				->with('newestmembers', $newestmembers)
				->with('onlinemembers', $onlinemembers);
	}

}
