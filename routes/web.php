<?php

use App\Models\Album;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlbumController;

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
//All Albums
Route::get('/', [AlbumController::class, 'index']);
//Single Album
Route::get('/album/{album}', [AlbumController::class, 'show']);
// here again

//Show Register form
Route::get('/register',[UserController::class, 'create'])->middleware('guest');
//Show Login form
Route::get('/login',[UserController::class, 'login'])
->name('login')
->middleware('guest');
//Create New User
Route::post('/users',[UserController::class, 'store']);
//Log user out
Route::post('/logout',[UserController::class, 'logout'])
->middleware('auth');
//Log In user
Route::post('/users/authenticate',[UserController::class, 'authenticate']);


//Edit User Informations
Route::get('/users/edit',[UserController::class,'edit'])
->middleware('auth');
//Update User Info
Route::put('/users/{user}', [UserController::class, 'update'])
->middleware('auth');

//Favourite albums list
Route::get('/users/likes',[UserController::class,'likes'])
->middleware('auth');

//Roles required to access: Admin or Writer
Route::middleware(['auth','role:admin'])->middleware(['auth','role:writer'])->group(function(){
    //Show Create Form
    Route::get('/albums/create', [AlbumController::class, 'create']);
    //Store Album Data
    Route::post('/albums', [AlbumController::class, 'store'])
    ->middleware('auth');
    //Show edit form
    Route::get('/albums/{album}/edit', [AlbumController::class, 'edit'])
    ->middleware('auth');
    //Update Album after edit
    Route::put('/albums/{album}', [AlbumController::class, 'update'])
    ->middleware('auth');
    //delete listing
    Route::delete('/albums/{album}', [AlbumController::class, 'destroy'])
    ->middleware('auth');
    //Manage Albums
    Route::get('/albums/manage',[AlbumController::class, 'manage'])
    ->middleware('auth');
});
