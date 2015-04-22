<?php namespace Curriculum\Http\Controllers;

use Request;

use Curriculum\Handlers\HandlerUtilities;
use Curriculum\Models\Classes;

class ClassController extends Controller {

	/**
	 * Constructs a new ClassController object.
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Get all class information from the current term
	 * @link /classes 	GET
	 * @return all classes, including the class_meeting and
	 * class_instructors for those classes
	 *
	 */
	public function index()
	{
		$term = HandlerUtilities::getCurrentTermID();

		$data = Classes::with('meetings', 'instructors')->where('term_id', $term);

		/* APPLY INSTRUCTOR FILTER */
		$instructor = Request::get('instructor', 0);
		if($instructor) {
			$data->hasInstructor($instructor);
		} else {
			$response = array(
				'status'      => 500,
				'success'	  => false,
				'version'     => 'curriculum-1.0',
				'type'		  => 'errors',
				'errors'	  => ['No filter paramters set']
			);

			return response($response, 500);
		}
	
		$prepped_data = HandlerUtilities::prepareClassesResponse($data->get());

		$response = array(
			'status'      => 200,
			'success'	  => true,
			'version'     => 'curriculum-1.0',
			'type'		  => 'classes',
			'classes'	  => $prepped_data
		);

		return response($response, 200);
	}

	/**
	 * Get class information for a specific class if a ticket number is given,
	 *	or class information for all classes with a specific subject and
	 *	catalog_number if subject-catalog_number is given. All the information
	 *  is for the current term
	 * @todo Exceptions in else block, and is_numeric check on ticket number
	 * @link /classes/{id} 	GET
	 * @internal Examples of possible $id
	 *		NAME 					EXAMPLE			 
	 *		association_id			classes:Summer-14:10472 		
	 * 		class_number			10402
	 *		subject 				comp
 	 *		subject-catalog_number 	comp-160
	 * @param int|string $id
	 * @return class
	 *
	 */
	public function show($id)
	{
		$term_id = HandlerUtilities::getCurrentTermID();

		$data = Classes::with('meetings', 'instructors')
			->where('term_id', $term_id)
			->whereIdentifier($id);
	
		/* APPLY INSTRUCTOR FILTER */
		$instructor = Request::get('instructor', 0);
		if($instructor) {
			$data->hasInstructor($instructor);
		}

		$prepped_data = HandlerUtilities::prepareClassesResponse($data->get());

		$response = array(
			'status'      => 200,
			'success'	  => true,
			'version'     => 'curriculum-1.0',
			'type'		  => 'classes',
			'classes'	  => $prepped_data
		);

		return response($response, 200);
	}
	
}