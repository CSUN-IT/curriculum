<?php

class ClassInstructorTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('class_instructor')->delete();

		ClassInstructor::create(array(
			'term_id' => 2137,
			'class_number' => 12000,
			'emplid' => '1',
			'instructor_role' => 'Best role ever',
			'instructor' => 'ani@csun.edu'
		));

		ClassInstructor::create(array(
			'term_id' => 2137,
			'class_number' => 12100,
			'emplid' => '1',
			'instructor_role' => 'Best role ever',
			'instructor' => 'ani@csun.edu'
		));

		ClassInstructor::create(array(
			'term_id' => 2143,
			'class_number' => 10147,
			'emplid' => '1',
			'instructor_role' => 'Best role ever',
			'instructor' => 'staff@csun.edu'
		));

		ClassInstructor::create(array(
			'term_id' => 2143,
			'class_number' => 10148,
			'emplid' => '1',
			'instructor_role' => 'Best role ever',
			'instructor' => 'pistolesi@csun.edu'
		));
	}

}