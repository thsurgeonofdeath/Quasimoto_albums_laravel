<?php

use App\Models\Album;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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
Route::get('/', [AlbumController::class, 'index'])->middleware('verified');
//Single Album
Route::get('/album/{album}', [AlbumController::class, 'show'])->middleware('verified');
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
->middleware('auth','verified');

//Update User Info
Route::put('/users/{user}/update', [UserController::class, 'update'])
->middleware('auth');

//Show user profile
Route::get('/users/display/{user}', [UserController::class, 'profile'])
->middleware('auth');

//Favourite albums list
Route::get('/users/likes',[UserController::class,'likes'])
->middleware('auth','verified');

//add reviews
Route::post('/addReview',[AlbumController::class, 'addReview'])
->middleware('auth');

//edit or delete reviews
Route::put('/editReview/{review}',[AlbumController::class, 'editReview'])
->middleware('auth');

//contact admin form
Route::get('/contact',[UserController::class, 'contactAdmin'])
->middleware('auth');

//send message
Route::post('/contactmessage/{user}',[UserController::class, 'storeMessage'])
->middleware('auth');

//Roles required to access: Admin or Writer
Route::middleware(['auth','role:admin'])->middleware(['auth','role:writer'])->group(function(){
    //Show Create Form
    Route::get('/albums/create', [AlbumController::class, 'create']);
    //Store Album Data
    Route::post('/albums', [AlbumController::class, 'store']);
    //Show edit form
    Route::get('/albums/{album}/edit', [AlbumController::class, 'edit']);
    //Update Album after edit
    Route::put('/albums/{album}', [AlbumController::class, 'update']);
    //delete listing
    Route::delete('/albums/{album}', [AlbumController::class, 'destroy']);
    //Manage Albums
    Route::get('/albums/manage',[AlbumController::class, 'manage']);
});


//Roles aquired to access: Admin Only!!!
Route::middleware(['auth','role:admin'])->group(function(){
    
    Route::get('users/dashboard',[UserController::class, 'dashboard']);

    Route::delete('/deleteReview/{review}',[AlbumController::class, 'deleteReview']);
});

// ijaboCropTool plug
Route::post('/crop',[UserController::class, 'crop'])->name('create.crop');




//Email Verification notice :
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

//The Email Verification Handler
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

//Resending The Verification Email
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');