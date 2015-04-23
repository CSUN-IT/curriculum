<?php namespace Curriculum\Http\Controllers;

use Auth,
	Request,
	Validator;

use Curriculum\Exceptions\PermissionDeniedException;
use Curriculum\Models\Course,
	Curriculum\Models\Term;

class AdminCourseController extends Controller {

	/**
	 * Constructs a new AdminCourseController object.
	 */
	public function __construct() {
		parent::__construct();

		// ensure the route makes use of authentication functionality
		$this->middleware('auth');
	}

	/**
	 * Handles the display of all courses.
	 * GET /admin/courses
	 *
	 * @return View
	 */
	public function index() {
		// perform permission check
		if(!Auth::user()->hasPerm('course.retrieve.all')) {
			throw new PermissionDeniedException(
				"You do not have permission to access this resource."
			);
		}

		// grab a set of paginated courses and set the pagination URL
		$courses = Course::orderBy('subject')
			->orderBy('catalog_number')
			->paginate(25);
		$courses->setPath(url('/admin/courses'));

		return view('pages.admin.courses.index', compact('courses'));
	}

	/**
	 * Handles the display of the Create Course screen.
	 * GET /admin/courses/create
	 *
	 * @return View
	 */
	public function create() {
		// perform permission check
		if(!Auth::user()->hasPerm('course.create')) {
			throw new PermissionDeniedException(
				"You do not have permission to access this resource."
			);
		}

		// grab the subjects so we have something for the drop-down on the view
		$subjects = Course::subjects()->lists('subject', 'subject');
		return view('pages.admin.courses.create', compact('subjects'));
	}

	/**
	 * Handles the submission from the Create Course screen.
	 * POST /admin/courses
	 *
	 * @return Response
	 */
	public function store() {
		// perform permission check
		if(!Auth::user()->hasPerm('course.create')) {
			throw new PermissionDeniedException(
				"You do not have permission to access this resource."
			);
		}

		// validate the input
		$validator = Validator::make(
			$input = [
				'course_id'			=> Request::get('course_id'),
				'title'				=> strtoupper(Request::get('title')),
				'subject'			=> Request::get('subject'),
				'catalog_number'	=> Request::get('catalog_number'),
			],
			$rules = [
				'course_id'			=> 'required|numeric|unique:omar.courses,course_id',
				'title'				=> 'required|max:255',
				'subject'			=> 'required|exists:omar.courses,subject',
				'catalog_number'	=> 'required|numeric',
			]
		);

		// if the validator fails kick them back
		if($validator->fails()) {
			return redirect()->back()->withInput()->withErrors($validator);
		}

		// create the new course
		$course = Course::create([
			'course_id' => $input['course_id'],
			'subject' => $input['subject'],
			'catalog_number' => $input['catalog_number'],
			'title' => $input['title']
		]);
		$course->touch();

		// redirect with a success message
		$success = "You have successfully created a new course.";
		return redirect(route('admin.courses.index'))->with('success', $success);
	}

	/**
	 * Handles the display of the Modify Course screen.
	 * GET /admin/courses/{id}/edit
	 *
	 * @param integer $id The ID of the course to modify
	 * @return View
	 */
	public function edit($id) {

	}

	/**
	 * Handles the submission from the Modify Course screen.
	 * PUT /admin/courses/{id}
	 *
	 * @return Response
	 */
	public function update($id) {

	}
}