<?php

use Illuminate\Database\Seeder;
use LANMS\Crew;
use LANMS\CrewCategory;
use LANMS\CrewSkill;
use LANMS\CrewSkillAttached;

class CrewTableSeeder extends Seeder  {

	public function run() {

		Crew::create([
			'user_id' 		=> 1,
			'category_id' 	=> 1,
			'author_id' 	=> 1,
			'editor_id' 	=> 1,
			'year'			=> 2018,
		]);

		Crew::create([
			'user_id' 		=> 2,
			'category_id' 	=> 2,
			'author_id' 	=> 1,
			'editor_id' 	=> 1,
			'year'			=> 2018,
		]);

		Crew::create([
			'user_id' 		=> 3,
			'category_id' 	=> 2,
			'author_id' 	=> 1,
			'editor_id' 	=> 1,
			'year'			=> 2018,
		]);

		CrewCategory::create([
			'title' 	=> 'Core',
			'slug' 		=> 'core',
			'author_id' => 1,
			'editor_id' => 1,
		]);

		CrewCategory::create([
			'title' 	=> 'Crew',
			'slug' 		=> 'crew',
			'author_id' => 1,
			'editor_id' => 1,
		]);

		CrewSkill::create([
			'title' 	=> 'Admin',
			'slug' 		=> 'admin',
			'icon' 		=> 'fa fa-user-secret',
			'label' 	=> 'label label-primary',
			'author_id' => 1,
			'editor_id' => 1,
		]);

		CrewSkill::create([
			'title' 	=> 'Network',
			'slug' 		=> 'network',
			'icon' 		=> 'fa fa-wifi',
			'label' 	=> 'label label-success',
			'author_id' => 1,
			'editor_id' => 1,
		]);

		CrewSkill::create([
			'title' 	=> 'Security',
			'slug' 		=> 'security',
			'icon' 		=> 'fa fa-lock',
			'label' 	=> 'label label-warning',
			'author_id' => 1,
			'editor_id' => 1,
		]);

		CrewSkillAttached::create([
			'user_id' 	=> 1,
			'skill_id' 	=> 1,
			'author_id' => 1,
			'editor_id' => 1,
			'year'		=> 2018,
		]);

		CrewSkillAttached::create([
			'user_id' 	=> 1,
			'skill_id' 	=> 2,
			'author_id' => 1,
			'editor_id' => 1,
			'year'		=> 2018,
		]);

		CrewSkillAttached::create([
			'user_id' 	=> 1,
			'skill_id' 	=> 3,
			'author_id' => 1,
			'editor_id' => 1,
			'year'		=> 2018,
		]);

		CrewSkillAttached::create([
			'user_id' 	=> 2,
			'skill_id' 	=> 2,
			'author_id' => 1,
			'editor_id' => 1,
			'year'		=> 2018,
		]);

		CrewSkillAttached::create([
			'user_id' 	=> 2,
			'skill_id' 	=> 3,
			'author_id' => 1,
			'editor_id' => 1,
			'year'		=> 2018,
		]);

		CrewSkillAttached::create([
			'user_id' 	=> 3,
			'skill_id' 	=> 3,
			'author_id' => 1,
			'editor_id' => 1,
			'year'		=> 2018,
		]);

	}
}