<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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
    return view('auth.login');
})->name('login-home');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	
	
	Route::resource('folder-manager', 'App\Http\Controllers\FolderController')
    ->names('folders')
	->parameters(['folder-manager' => 'folder']);

	Route::resource('file-manager', 'App\Http\Controllers\FolderController')
	->names('files')
	->parameters(['file-manager' => 'file']);

	// Las siete rutas REST <p
    // Route::get ('/portafolio', 'ProjectController@index')->name('projects.index');
    // Route::get ('/portafolio/crear', 'ProjectController@create')->name('projects.create');
    // Route::get ('/portafolio/{project}/editar', 'ProjectController@edit')->name('projects.edit');
    // Route::patch ('/portafolio/{project}', 'ProjectController@update')->name('projects.update');
    // Route::post ('/portafolio', 'ProjectController@store')->name('projects.store');
    // Route::get ('/portafolio/{project}', 'ProjectController@show')->name('projects.show');
    // Route::delete ('/portafolio/{project}', 'ProjectController@destroy')->name('projects.destroy');
	
	// Route::get('notifications', function () {
	// 	return view('pages.notifications');
	// })->name('notifications');

});



Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

