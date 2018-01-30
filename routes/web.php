<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// ------------------------------------------------
//
// BEGIN TEMPORARY LEGACY API ROUTES
//
// ------------------------------------------------

// class info with current term
$router->get('/classes', ['uses' => 'ClassController@index', 'version' => '1.0']);
$router->get('/classes/{id}', ['uses' => 'ClassController@show', 'version' => '1.0']);

// class info with specific term
$router->get('/terms/{term}/classes', ['uses' => 'TermController@classesIndex', 'version' => '1.0']);
$router->get('/terms/{term}/classes/{id}', ['uses' => 'TermController@classesShow', 'version' => '1.0']);

// course info with current term
$router->get('/courses', ['uses' => 'CourseController@index', 'version' => '1.0']);
$router->get('/courses/{id}', ['uses' => 'CourseController@show', 'version' => '1.0']);

// course info with specific term
$router->get('/terms/{term}/courses', ['uses' => 'TermController@coursesIndex', 'version' => '1.0']);
$router->get('/terms/{term}/courses/{id}', ['uses' => 'TermController@coursesShow', 'version' => '1.0']);

// plan information
$router->get('/plans', ['uses' => 'PlanController@index', 'version' => '1.0']);
$router->get('/plans/graduate', ['uses' => 'PlanController@graduateIndex', 'version' => '1.0']);
$router->get('/plans/{plan}', ['uses' => 'PlanController@Show', 'version' => '1.0']);

// ------------------------------------------------
//
// END TEMPORARY LEGACY ROUTES
//
// ------------------------------------------------
$router->get('/about/version-history', function(){
    return view('pages.about.version-history');
});

// landing page and catch-all
$router->get('/', 'HomeController@getIndex');



