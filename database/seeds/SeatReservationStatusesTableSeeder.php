<?php

use Illuminate\Database\Seeder;
use LANMS\SeatReservationStatus;

class SeatReservationStatusesTableSeeder extends Seeder  {

	public function run() {

		SeatReservationStatus::create([
			'name' 		=> 'Reserved',
			'slug' 		=> 'reserved',
		]);

		SeatReservationStatus::create([
			'name' 		=> 'Temporary Reserved',
			'slug' 		=> 'temporary_reserved',
		]);
	}
}