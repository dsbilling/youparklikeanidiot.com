<?php

use Illuminate\Database\Seeder;
use DPSEI\Page;

class PagesTableSeeder extends Seeder  {

	public function run() {

		Page::create([
			'title' 		=> 'Om',
			'slug' 			=> 'om',
			'content'		=> '
			<p>Denne siden kan kanskje virke litt "dust", men det er ikke hensikten.</p>
			<h3>Hvorfor bruker dere ordet "idiot"?</h3>
			<p>Det kan kanskje virke nedverdigende for noen folk imens andre tar ikke dette ordet seriøst. Det finnes mange beskrivende ord, men dette er det var det åpenbare ordet å bruke når dette prosjektet startet. Mange mener at dette ordet er det best beskrivende ordet for dem som parkerer slik som de parkerer.</p>
			',
			'showinmenu'	=> 1,
			'author_id'		=> 1,
		]);

		Page::create([
			'title' 		=> 'Terms of Service',
			'slug' 			=> 'tos',
			'content'		=> '
			<p>Nothing here yet.</p>
			',
			'showinmenu'	=> 0,
			'author_id'		=> 1,
		]);

		Page::create([
			'title' 		=> 'Privacy Policy',
			'slug' 			=> 'privacy',
			'content'		=> '
			<p>Nothing here yet.</p>
			',
			'showinmenu'	=> 0,
			'author_id'		=> 1,
		]);
		

	}
}