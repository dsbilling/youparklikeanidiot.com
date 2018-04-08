<?php

use Illuminate\Database\Seeder;
use LANMS\User;
  
class UserTableSeeder extends Seeder {
  
	public function run() {

		// Create Users
		Sentinel::registerAndActivate([
			'email' 		=> 'd@rtrdt.ch',
			'password' 		=> '12345678', // Den hash'r automatisk
			'firstname' 	=> 'Daniel',
			'lastname'	 	=> 'SADMIN',
			'username' 		=> 'sadmin',
			'referral_code'	=> str_random(15),
		]);
		Sentinel::registerAndActivate([
			'email' 		=> 'test@rtrdt.ch',
			'password' 		=> '12345678', // Den hash'r automatisk
			'firstname' 	=> 'John',
			'lastname'	 	=> 'ADMIN',
			'username' 		=> 'admin',
			'referral_code'	=> str_random(15),
		]);
		Sentinel::registerAndActivate([
			'email' 		=> 'test2@rtrdt.ch',
			'password' 		=> '12345678', // Den hash'r automatisk
			'firstname' 	=> 'John',
			'lastname'	 	=> 'MOD',
			'username' 		=> 'mod',
			'referral_code'	=> str_random(15),
		]);
		Sentinel::registerAndActivate([
			'email' 		=> 'test3@rtrdt.ch',
			'password' 		=> '12345678', // Den hash'r automatisk
			'firstname' 	=> 'John',
			'lastname'	 	=> 'USER',
			'username' 		=> 'user',
			'referral_code'	=> str_random(15),
		]);
		Sentinel::registerAndActivate([
			'email' 		=> 'test4@rtrdt.ch',
			'password' 		=> '12345678', // Den hash'r automatisk
			'firstname' 	=> 'John',
			'lastname'	 	=> 'USER2',
			'username' 		=> 'user2',
			'referral_code'	=> str_random(15),
		]);

		//Create Roles
		$role = Sentinel::getRoleRepository()->createModel()->create([
		    'name' => 'Moderators',
		    'slug' => 'mod',
		]);
		$role = Sentinel::getRoleRepository()->createModel()->create([
		    'name' => 'Administrators',
		    'slug' => 'admin',
		]);
		$role = Sentinel::getRoleRepository()->createModel()->create([
		    'name' => 'Super Administrators',
		    'slug' => 'superadmin',
		]);

		// Add users to groups
		$user = Sentinel::findById(1);
		$role = Sentinel::findRoleByName('Super Administrators');
		$role->users()->attach($user);

		$user = Sentinel::findById(2);
		$role = Sentinel::findRoleByName('Administrators');
		$role->users()->attach($user);

		$user = Sentinel::findById(3);
		$role = Sentinel::findRoleByName('Moderators');
		$role->users()->attach($user);

		//Add permissions to roles
		$role = Sentinel::findRoleByName('Super Administrators');

		$role->addPermission('admin');//admin panel access

		$role->addPermission('admin.crew.create');
		$role->addPermission('admin.crew.update');
		$role->addPermission('admin.crew.destroy');
		$role->addPermission('admin.crew.restore');

		$role->addPermission('admin.crew-category.create');
		$role->addPermission('admin.crew-category.update');
		$role->addPermission('admin.crew-category.destroy');
		$role->addPermission('admin.crew-category.restore');

		$role->addPermission('admin.crew-skill.create');
		$role->addPermission('admin.crew-skill.update');
		$role->addPermission('admin.crew-skill.destroy');
		$role->addPermission('admin.crew-skill.restore');

		$role->addPermission('admin.news.create');
		$role->addPermission('admin.news.update');
		$role->addPermission('admin.news.destroy');
		$role->addPermission('admin.news.restore');

		$role->addPermission('admin.newscategory.create');
		$role->addPermission('admin.newscategory.update');
		$role->addPermission('admin.newscategory.destroy');
		$role->addPermission('admin.newscategory.restore');

		$role->addPermission('admin.pages.create');
		$role->addPermission('admin.pages.update');
		$role->addPermission('admin.pages.destroy');
		$role->addPermission('admin.pages.restore');

		$role->addPermission('admin.seating.row.create');
		$role->addPermission('admin.seating.row.update');
		$role->addPermission('admin.seating.row.destroy');
		$role->addPermission('admin.seating.row.restore');

		$role->addPermission('admin.seating.seat.create');
		$role->addPermission('admin.seating.seat.update');
		$role->addPermission('admin.seating.seat.destroy');
		$role->addPermission('admin.seating.seat.restore');

		$role->addPermission('admin.reservation.create');
		$role->addPermission('admin.reservation.update');
		$role->addPermission('admin.reservation.destroy');
		$role->addPermission('admin.reservation.restore');

		$role->addPermission('admin.checkin.create');
		$role->addPermission('admin.checkin.update');
		$role->addPermission('admin.checkin.destroy');
		$role->addPermission('admin.checkin.restore');

		$role->addPermission('admin.print.create');
		$role->addPermission('admin.print.update');
		$role->addPermission('admin.print.destroy');
		$role->addPermission('admin.print.restore');

		$role->addPermission('admin.info.update');

		$role->addPermission('admin.sponsor.create');
		$role->addPermission('admin.sponsor.update');
		$role->addPermission('admin.sponsor.destroy');
		$role->addPermission('admin.sponsor.restore');

		$role->addPermission('admin.settings.update');
		$role->addPermission('admin.license.update');

		$role->save();


		$role = Sentinel::findRoleByName('Administrators');

		$role->addPermission('admin');//admin panel access

		$role->addPermission('admin.crew.create');
		$role->addPermission('admin.crew.update');
		$role->addPermission('admin.crew.destroy');
		$role->addPermission('admin.crew.restore', false);

		$role->addPermission('admin.crew-category.create');
		$role->addPermission('admin.crew-category.update');
		$role->addPermission('admin.crew-category.destroy');
		$role->addPermission('admin.crew-category.restore', false);

		$role->addPermission('admin.crew-skill.create');
		$role->addPermission('admin.crew-skill.update');
		$role->addPermission('admin.crew-skill.destroy');
		$role->addPermission('admin.crew-skill.restore', false);

		$role->addPermission('admin.news.create');
		$role->addPermission('admin.news.update');
		$role->addPermission('admin.news.destroy');
		$role->addPermission('admin.news.restore', false);

		$role->addPermission('admin.newscategory.create');
		$role->addPermission('admin.newscategory.update');
		$role->addPermission('admin.newscategory.destroy');
		$role->addPermission('admin.newscategory.restore', false);

		$role->addPermission('admin.pages.create');
		$role->addPermission('admin.pages.update');
		$role->addPermission('admin.pages.destroy');
		$role->addPermission('admin.pages.restore', false);

		$role->addPermission('admin.seating.row.create');
		$role->addPermission('admin.seating.row.update');
		$role->addPermission('admin.seating.row.destroy');
		$role->addPermission('admin.seating.row.restore', false);

		$role->addPermission('admin.seating.seat.create');
		$role->addPermission('admin.seating.seat.update');
		$role->addPermission('admin.seating.seat.destroy');
		$role->addPermission('admin.seating.seat.restore', false);

		$role->addPermission('admin.reservation.create');
		$role->addPermission('admin.reservation.update');
		$role->addPermission('admin.reservation.destroy');
		$role->addPermission('admin.reservation.restore', false);

		$role->addPermission('admin.checkin.create');
		$role->addPermission('admin.checkin.update');
		$role->addPermission('admin.checkin.destroy');
		$role->addPermission('admin.checkin.restore', false);

		$role->addPermission('admin.print.create');
		$role->addPermission('admin.print.update');
		$role->addPermission('admin.print.destroy');
		$role->addPermission('admin.print.restore', false);

		$role->addPermission('admin.info.update');

		$role->addPermission('admin.sponsor.create');
		$role->addPermission('admin.sponsor.update');
		$role->addPermission('admin.sponsor.destroy');
		$role->addPermission('admin.sponsor.restore', false);

		$role->addPermission('admin.settings.update', false);
		$role->addPermission('admin.license.update', false);

		$role->save();


		$role = Sentinel::findRoleByName('Moderators');

		$role->addPermission('admin');//admin panel access

		$role->addPermission('admin.crew.create');
		$role->addPermission('admin.crew.update');
		$role->addPermission('admin.crew.destroy', false);
		$role->addPermission('admin.crew.restore', false);

		$role->addPermission('admin.crew-category.create');
		$role->addPermission('admin.crew-category.update');
		$role->addPermission('admin.crew-category.destroy', false);
		$role->addPermission('admin.crew-category.restore', false);

		$role->addPermission('admin.crew-skill.create');
		$role->addPermission('admin.crew-skill.update');
		$role->addPermission('admin.crew-skill.destroy', false);
		$role->addPermission('admin.crew-skill.restore', false);

		$role->addPermission('admin.news.create');
		$role->addPermission('admin.news.update');
		$role->addPermission('admin.news.destroy', false);
		$role->addPermission('admin.news.restore', false);

		$role->addPermission('admin.newscategory.create');
		$role->addPermission('admin.newscategory.update');
		$role->addPermission('admin.newscategory.destroy', false);
		$role->addPermission('admin.newscategory.restore', false);

		$role->addPermission('admin.pages.create');
		$role->addPermission('admin.pages.update');
		$role->addPermission('admin.pages.destroy', false);
		$role->addPermission('admin.pages.restore', false);

		$role->addPermission('admin.seating.row.create');
		$role->addPermission('admin.seating.row.update');
		$role->addPermission('admin.seating.row.destroy', false);
		$role->addPermission('admin.seating.row.restore', false);

		$role->addPermission('admin.reservation.create');
		$role->addPermission('admin.reservation.update');
		$role->addPermission('admin.reservation.destroy', false);
		$role->addPermission('admin.reservation.restore', false);

		$role->addPermission('admin.seating.seat.create');
		$role->addPermission('admin.seating.seat.update');
		$role->addPermission('admin.seating.seat.destroy', false);
		$role->addPermission('admin.seating.seat.restore', false);

		$role->addPermission('admin.checkin.create');
		$role->addPermission('admin.checkin.update');
		$role->addPermission('admin.checkin.destroy', false);
		$role->addPermission('admin.checkin.restore', false);

		$role->addPermission('admin.print.create');
		$role->addPermission('admin.print.update');
		$role->addPermission('admin.print.destroy', false);
		$role->addPermission('admin.print.restore', false);

		$role->addPermission('admin.info.update', false);

		$role->addPermission('admin.sponsor.create');
		$role->addPermission('admin.sponsor.update');
		$role->addPermission('admin.sponsor.destroy', false);
		$role->addPermission('admin.sponsor.restore', false);

		$role->addPermission('admin.settings.update', false);
		$role->addPermission('admin.license.update', false);

		$role->save();

	}
}