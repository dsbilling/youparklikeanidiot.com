<?php

namespace LANMS\Http\Controllers\Member;

use LANMS\Http\Controllers\Controller;
use LANMS\User;

use LANMS\Http\Requests\Member\SearchRequest;

class MemberController extends Controller {

	public function profile($username) {
		$theuser = User::where('username', '=', $username)->first();
		if($theuser == null) {
			return abort(404); //if username does not exist
		}
		$onlinestatus = User::getOnlineStatus($theuser->id);
		$userarray = $theuser->toArray();
		$userarray['onlinestatus'] = $onlinestatus;
		return view('members.profile')->with($userarray);
	}

	public function index() {
		$members = User::orderBy('username', 'asc')->where('last_activity', '<>', '')->paginate(10);
		$newestmembers = User::orderBy('created_at', 'desc')->where('last_activity', '<>', '')->take(4)->get();
		$onlinemembers = User::orderBy('last_activity', 'desc')->where('last_activity', '<>', '')->take(4)->get();
		
		return view('members.index')
				->with('members', $members)
				->with('newestmembers', $newestmembers)
				->with('onlinemembers', $onlinemembers);
	}

	public function search(SearchRequest $request) {

		$members = \Searchy::users('firstname', 'lastname', 'username')->query($request->search)->get();

		$newestmembers = User::orderBy('created_at', 'desc')->where('last_activity', '<>', '')->take(4)->get();
		$onlinemembers = User::orderBy('last_activity', 'desc')->where('last_activity', '<>', '')->take(4)->get();
		
		return view('members.search')
				->with('query', $request->search)
				->with('members', $members)
				->with('newestmembers', $newestmembers)
				->with('onlinemembers', $onlinemembers);
	}

}
