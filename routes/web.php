<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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
//All Listings
Route::get('/', [ListingController::class, 'index']);
//Single Listing
Route::get('/listing/{listing}', [ListingController::class, 'show']);
//Show Create Form
Route::get('/listings/create', [ListingController::class, 'create'])
->middleware('auth');
//Store Listing Data
Route::post('/listings', [ListingController::class, 'store'])
->middleware('auth');
//Show edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])
->middleware('auth');
//Update listings after edit
Route::put('/listings/{listing}', [ListingController::class, 'update'])
->middleware('auth');
//delete listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])
->middleware('auth');

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




