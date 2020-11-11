<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!w
|
*/

	
	Route::resource('folders', 'App\Http\Controllers\FolderController')
    ->names('folders')
	->parameters(['folders' => 'folder']);



Route::get('users', [App\Http\Controllers\UserController::class, 'index'])->name('user');
Route::get('files', [App\Http\Controllers\FileController::class, 'index']);
Route::get('files/{id}', [App\Http\Controllers\FileController::class, 'show']);
Route::get('categories', [App\Http\Controllers\CategoryController::class, 'index']);

    
    // return datatables()
    //     ->eloquent(User::query())
    //     ->toJson();

