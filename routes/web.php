<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::get('/', function () {
    return view('welcome');
});


/*
    GET /projects (index)
    Get /projects/create (create)
    GET /projects/1 (show)
    POST /projects (store)
    GET /projects/1/edit (edit)
    PATCH /projects/1 (update)
    DELETE /projects/1 (destroy)


*/

Route::resource('projects', 'ProjectsController'); //Creo todos los endpoint de abajo

/* Route::get('/projects', 'ProjectsController@index');
Route::get('/projects/create', 'ProjectsController@create');
Route::get('/projects/{project}','ProjectsController@show');
Route::post('/projects', 'ProjectsController@store');
Route::get('/projects/{project}/edit','ProjectsController@edit');
Route::patch('/projects/{project}/edit','ProjectsController@update');
Route::delete('/projects/{project}','ProjectsController@destroy'); */


Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');
Route::patch('/tasks/{task}' , 'ProjectTasksController@update');

    //puedo poner Route::patch('/tasks/{task}' , 'ProjectTasksController@update')->middleware(auth); para pedir auth


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
