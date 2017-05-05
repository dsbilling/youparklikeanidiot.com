<?php

use Illuminate\Database\Seeder;
use DPSEI\User;
  
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

		$role->addPermission('admin.settings.update');

		$role->save();


		$role = Sentinel::findRoleByName('Administrators');

		$role->addPermission('admin');//admin panel access

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

		$role->addPermission('admin.settings.update', false);

		$role->save();


		$role = Sentinel::findRoleByName('Moderators');

		$role->addPermission('admin');//admin panel access

		$role->addPermission('admin.news.create', false);
		$role->addPermission('admin.news.update');
		$role->addPermission('admin.news.destroy', false);
		$role->addPermission('admin.news.restore', false);

		$role->addPermission('admin.newscategory.create', false);
		$role->addPermission('admin.newscategory.update', false);
		$role->addPermission('admin.newscategory.destroy', false);
		$role->addPermission('admin.newscategory.restore', false);

		$role->addPermission('admin.pages.create', false);
		$role->addPermission('admin.pages.update');
		$role->addPermission('admin.pages.destroy', false);
		$role->addPermission('admin.pages.restore', false);

		$role->addPermission('admin.settings.update', false);

		$role->save();

	}
}