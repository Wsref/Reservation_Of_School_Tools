<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MaterielController;
use App\Http\Controllers\Admin\ReservationMaterielController;
use App\Http\Controllers\Admin\ReservationTerainController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

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

Route::get('/',[HomeController::class,'index']);

// -----------------------------------Dashboard-----------------------------------------------

Route::get('/admin',[DashboardController::class,'index']);

// -----------------------------------Materiel-----------------------------------------------

Route::get('/materiel_est',[MaterielController::class,'show_materiel']);

Route::post('/save-materiel',[MaterielController::class,'save_materiel']);

Route::get('/edit-materiel/yxwiu={id}',[MaterielController::class,'edit_materiel']);

Route::put('/update-materiel/vbgf={id}',[MaterielController::class,'update_materiel']);

Route::delete('/delete-materiel/yxkpq={id}',[MaterielController::class,'delete_materiel']);

Route::get('/search-materiel',[MaterielController::class,'search_materiel']);

// -----------------------------------Resérvations Terain-----------------------------------------------

Route::get('/reservationTerain',[ReservationTerainController::class,'index']);

Route::get('/reservation_data',[ReservationTerainController::class,'get_data_reserv']);

Route::get('/reservation_data/id={id}',[ReservationTerainController::class,'get_data_reserv_user']);

// -----------------------------------Resérvations Matériel-----------------------------------------------

Route::get('/reservationMateriel',[ReservationMaterielController::class,'index']);

Route::get('/reservation_data_materiel',[ReservationMaterielController::class,'get_data_reserv']);

Route::get('/reservation_data_materiel/id={id}',[ReservationMaterielController::class,'get_data_reserv_user_materiel']);

// -----------------------------------Utilisateurs-----------------------------------------------

Route::get('/users_est',[AdminUserController::class,'index']);






//authentification etc later 

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
