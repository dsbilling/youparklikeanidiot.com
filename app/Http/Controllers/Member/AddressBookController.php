<?php namespace LANMS\Http\Controllers\Member;

use LANMS\Http\Requests;
use LANMS\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Redirect;

use LANMS\Address;

use LANMS\Http\Requests\Member\AddressCreateRequest;

class AddressBookController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$addresses = Sentinel::getUser()->addresses;
		return view('account.addressbook.index')->with('addresses', $addresses);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('account.addressbook.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(AddressCreateRequest $request)
	{
		$credentials = [
			'username' 		=> Sentinel::getUser()->username,
			'password' 		=> $request->get('password'),
		];

		if (Sentinel::authenticate($credentials)) {
			$main_address = 0;
			if($request->get('main_address') == "on") {
				$main_address = 1;
			}

			if(Address::where('user_id', '=', Sentinel::getUser()->id)->where('main_address', '=', 1)->count() == 0) {
				$main_address = 1;
			}

			if($main_address == 1) {
				// Set all other addresses to non-main_address
				Address::where('user_id', '=', Sentinel::getUser()->id)->update(['main_address' => 0]);
			}

			$address 				= new Address;
			$address->address1 		= $request->get('address1');
			$address->address2 		= $request->get('address2');
			$address->postalcode 	= $request->get('postalcode');
			$address->city 			= $request->get('city');
			$address->county 		= $request->get('county');
			$address->country 		= $request->get('country');
			$address->main_address 		= $main_address;
			$address->user_id		= Sentinel::getUser()->id;

			$adresssave = $address->save();

			if($adresssave) {

				//give user rights to edit address
				$user = Sentinel::getUser();
				$user->addPermission('address.'.$address->id.'.edit');
				$user->addPermission('address.'.$address->id.'.destroy');
				$user->save();

				return Redirect::route('account-addressbook')
						->with('messagetype', 'success')
						->with('message', 'The address has now been added!');
			} else {
				return Redirect::route('account-addressbook-create')
					->with('messagetype', 'danger')
					->with('message', 'Something went wrong while saving the address to the address book.');
			}
		} else {
			return Redirect::route('account-addressbook-create')
					->with('messagetype', 'warning')
					->with('message', 'Your current password does not seem to match.')->withInput();
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
		if (Sentinel::getUser()->hasAccess(['address.'.$id.'.edit'])) {
			$address = Address::find($id);
			return view('account.addressbook.edit')->with($address->toArray());
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
	public function update($id, AddressCreateRequest $request)
	{
		if (Sentinel::getUser()->hasAccess(['address.'.$id.'.edit'])) {

			$credentials = [
				'username' 		=> Sentinel::getUser()->username,
				'password' 		=> $request->get('password'),
			];

			if (Sentinel::authenticate($credentials)) {

				$main_address = 0;
				if($request->get('main_address') == "on") {
					$main_address = 1;
				}

				if($main_address == 1) {
					// Set all other addresses to non-main_address
					Address::where('user_id', '=', Sentinel::getUser()->id)->where('id', '!=', $id)->update(['main_address' => false]);
				}

				if(Address::where('user_id', '=', Sentinel::getUser()->id)->where('id', '!=', $id)->where('main_address', '=', 1)->count() < 1) {
					$main_address = 1;
				}

				$address 				= Address::find($id);
				$address->address1 		= $request->get('address1');
				$address->address2 		= $request->get('address2');
				$address->postalcode 	= $request->get('postalcode');
				$address->city 			= $request->get('city');
				$address->county 		= $request->get('county');
				$address->country 		= $request->get('country');
				$address->main_address 	= $main_address;

				if($address->save()) {
					return Redirect::route('account-addressbook')
							->with('messagetype', 'success')
							->with('message', 'The address has now been updated!');
				} else {
					return Redirect::route('account-addressbook-edit', $id)
						->with('messagetype', 'danger')
						->with('message', 'Something went wrong while saving the changes to the address.');
				}
			} else {
				return Redirect::route('account-addressbook-edit', $id)
						->with('messagetype', 'warning')
						->with('message', 'Your current password does not seem to match.');
			}

		} else {
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if (Sentinel::getUser()->hasAccess(['address.'.$id.'.destroy'])) {

			if(Sentinel::getUser()->reservations->count() <> 0) {
				return Redirect::route('account-addressbook')
									->with('messagetype', 'warning')
									->with('message', 'You are not allowed to delete any addresses while you have reserved seats.');
			}

			$address = Address::find($id);
			
			if($address->main_address) {
				$uaddress = Address::where('user_id', '=', Sentinel::getUser()->id)->where('id', '<>', $id)->first();
				if($uaddress <> null) {
					$uaddress->main_address = 1;
					$uaddress->save();
				}
			}

			if($address->delete()) {
				return Redirect::route('account-addressbook')
						->with('messagetype', 'success')
						->with('message', 'The address has now been deleted!');
			} else {
				return Redirect::route('account-addressbook')
					->with('messagetype', 'danger')
					->with('message', 'Something went wrong while deleting the address.');
			}
			//Remove User Permissions
			$user = Sentinel::getUser();
			$user->removePermission('address.'.$id.'.destroy');
			$user->save();
		} else {
			return Redirect::route('account-addressbook')->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}

}
