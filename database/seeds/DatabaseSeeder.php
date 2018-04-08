<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('UserTableSeeder');
		$this->call('NewsSeeder');
		$this->call('SettingsTableSeeder');
		$this->call('SeatsTableSeeder');
		$this->call('SeatRowsTableSeeder');
		$this->call('SeatReservationStatusesTableSeeder');
		$this->call('PagesTableSeeder');
		$this->call('CrewTableSeeder');
		$this->call('InfoTableSeeder');
		
	}

}
