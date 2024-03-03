<?php

use App\Models\messages;
use App\Models\individuals;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Route;
use App\Http\Controllers\messagesController;
// use App\Http\Controllers\DashboardController;
use App\Http\Controllers\individuaController;
use App\Http\Controllers\material_borrowController;
use App\Models\material_borrow;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MaterielController;
use App\Http\Controllers\Admin\ReservationMaterielController;
use App\Http\Controllers\Admin\ReservationTerainController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\UserController;
use App\Models\Reservationm;
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
// Route::get('/', function () {
//     return view('welcome');
// });
 
// Route::get('/',[DashboardController::class,'index']); ////!!!



Route::get('/', function () {
    return view('layouts.master');
});


// Route::get('/',[HomeController::class,'index']); //!!!!!!!!

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

// Route::get('/users_est',[AdminUserController::class,'index']);


// -----------------------------------Utilisateurs-----------------------------------------------
Route::get('/users' , [individuaController::class , 'usersview']);

Route::get('/reLoad_filtered_Users', [individuaController::class,'filterANDreload']);

Route::get('/users/{id}', [individuaController::class , 'userdata']);

            // ------------utilisateurs -> reservations de chaque utilisateur (data rows , chart ...) ------------------

Route::get('/get-borrows',[material_borrowController::class,'getBorrows']);

Route::get('/get-borrows-html/{id}',[material_borrowController::class,'getBorrowsHtml']);

Route::get('/get-borrows-chart-html',[material_borrowController::class,'getBorrowChartsHtml']);

// -----------------------------------Chat-----------------------------------------------

Route::get('/users/{id}/chat' , [individuaController::class , 'render_Chat']);

// Route::get('/load-UsermsgBox/{id}',[material_borrowController::class,'load_UsermsgBox']);
// Route::get('/load-UsermsgBox/{id}',[messagesController::class,'load_UsermsgBox']);
//TODO in fact we should include  correspondant admin id to get data , but we'll rely on one with id 1 from now

Route::get('/load-UserData/{id}',[material_borrowController::class,'load_UserData']);

Route::get('/load-UsermsgBoxAJAX/{id}',[messagesController::class,'load_UsermsgBoxAJAX']);

Route::put('/update/{id}', [messagesController::class,'update'])->name('update'); //update for confirm or drop request (reservation)

Route::get('/get-data', function() { 
    //getting requester_id
    // $requester = DB::select('select * from user_messages where request_id= ?', [$request_id]);
    $requester = Reservationm::select(
        'id',
        DB::raw('(SELECT name FROM materiels WHERE reservationms.materiel_id = materiels.id) as request_msg')
    )->get();

    if ($requester) {
        return response()->json($requester);
    } else {
            // Log error or return appropriate response for empty result
    // return response()->json(['error' => 'Requester not found for id ' . $request_id], 404);
}
})->name('get_requester_id');

Route::get('/get-data/{request_id}', function($request_id) { 
    //getting requester_id
    // $requester = DB::select('select * from user_messages where request_id= ?', [$request_id]);
    $requester = Reservationm::find($request_id);


    if ($requester) {
        return response()->json($requester);
    } else {
            // Log error or return appropriate response for empty result
    // return response()->json(['error' => 'Requester not found for id ' . $request_id], 404);
}
})->name('get_requester_id2');



//authentification etc later 

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
