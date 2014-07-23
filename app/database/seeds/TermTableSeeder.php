<?php

class TermTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('terms')->delete();

		Term::create(array(			
			'term_id' => 2143,
			'term' => 'Spring-2014',
			'description' => 'Spring 2014',
			'description_short' => 'Spring \'14',
			'begin_date' => date("Y-m-d H:i:s", mktime(0, 0, 0, 1, 21, 2014)),
			'end_date' => date("Y-m-d H:i:s", mktime(0, 0, 0, 5, 23, 2016))
		));

		Term::create(array(			
			'term_id' => 2137,
			'term' => 'Fall-2013',
			'description' => 'Fall 2013',
			'description_short' => 'Fall \'14',
			'begin_date' => date("Y-m-d H:i:s", mktime(0, 0, 0, 8, 24, 2013)),
			'end_date' => date("Y-m-d H:i:s", mktime(0, 0, 0, 12, 23, 2016))
		));
	}

}