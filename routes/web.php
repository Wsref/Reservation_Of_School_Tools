<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\individuaController;
use App\Http\Controllers\material_borrowController;
use Illuminate\Support\Facades\Route;
use App\Models\individuals;
use App\Models\messages;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::get('/', function () {
//     return view('welcome');
// });
 
Route::get('/',[DashboardController::class,'index']);

// Route::get('/', function () {
//     return view('layouts.master');
// });

Route::get('/users', function () {
    return view('usersview',['users'=> individuals::all()]);
});


Route::get('/users/{id}', function ($id) {
    return view('user',['user'=> individuals::find($id)]);
});

Route::get('/users/{id}/chat', function ($id) {
    return view('chat',[ 'users'=>individuals::all() , 'user'=> individuals::find($id) , 'msgdata'=> messages::getUsermsgs($id)]);
});

Route::get('/get-borrows',[material_borrowController::class,'getBorrows']);

Route::get('/get-borrows-html',[material_borrowController::class,'getBorrowsHtml']);

Route::get('/get-borrows-chart-html',[material_borrowController::class,'getBorrowChartsHtml']);

Route::get('/load-UsermsgBox/{id}',[material_borrowController::class,'load_UsermsgBox']);
// id will be passed automatically since the method has that parameter

Route::get('/load-UserData/{id}',[material_borrowController::class,'load_UserData']);

