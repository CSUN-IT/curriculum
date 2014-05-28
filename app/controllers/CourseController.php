<?php

class CourseController extends \BaseController {

	/**
	 * Get all course information for the current term
	 * @link /courses 	GET
	 * @return all courses for the current term
	 *
	 */
	public function index()
	{
		$term = $this->getCurrentTermCode();
		$data = Classes::where('sterm', $term);

		$data = $data->get()->toArray();
		$this->removeDuplicateCourses($data);
		$this->prepareCoursesResponse($data);

		$response = array(
			'status'      => 200,
			'success'	  => true,
			'version'     => 'omar-1.0',
			'type'		  => 'courses',
			'courses'	  => $data
		);

		return Response::make($response, 200);
	}

	/**
	 * Get course information for a specific course, given a subject,
	 *  for the current term
	 * @todo Exceptions in else block
	 * @link /courses/{id} 	GET
	 * @param string $id
	 * @return course info for a subject, all for the current term
	 *
	 */
	public function show($id)
	{
		$term = $this->getCurrentTermCode();
		$data = Classes::where('sterm', $term);

		$id_array = explode('-', $id);
		$id_array_size = count($id_array);

		//Is the $id a ticket number?
		if($id_array_size == 1){
			//Add is_numeric check?
			$data = $data->where('subject', $id);
		} 

		//Is the $id a subject-catalog_number
		elseif($id_array_size == 2){
			$subject = $id_array[0];
			$catalog_number = $id_array[1];
			$data = $data->where('subject', $subject)->where('catalog_number', $catalog_number);
		} else{
			//throw some stuff
		}

		$data = $data->get()->toArray();
		$this->removeDuplicateCourses($data);
		$this->prepareCoursesResponse($data);

		$response = array(
			'status'      => 200,
			'success'	  => true,
			'version'     => 'omar-1.0',
			'type'		  => 'courses',
			'courses'	  => $data
		);

		return Response::make($response, 200);
	}
}