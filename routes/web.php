<?php

use App\Http\Controllers\Admin\DashboardController as DashboardAdminController ;
use App\Http\Controllers\Admin\EvenmentController;
use App\Http\Controllers\Admin\LoginAdminController;
use App\Http\Controllers\Admin\MaterielController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\ReservationMaterielController;
use App\Http\Controllers\Admin\ReservationSalleController;
use App\Http\Controllers\Admin\ReservationTerainController;
use App\Http\Controllers\Admin\SalleController;
use App\Http\Controllers\Admin\TerainController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Home\HomeController;

// -----compte user
use App\Http\Controllers\Authentification\LoginController;
use App\Http\Controllers\Authentification\LogoutController;
use App\Http\Controllers\UserAcceuil\DashboardController;
use App\Http\Controllers\UserHelp\UserfaqsController;
use App\Http\Controllers\UserMesReservation\MyreservationsController;
use App\Http\Controllers\UserNotification\UserNotificationController;
use App\Http\Controllers\UserProfil\UserManagePasswordController;
use App\Http\Controllers\UserProfil\UserProfilController;
use App\Http\Controllers\UserReservationMateriel\UserReservationMaterielNextController;
use App\Http\Controllers\UserReservationMateriel\UserReservationMaterielController;
use App\Http\Controllers\userReservationSallle\UserReservationSalleController;
use App\Http\Controllers\UserReservatonTerain\UserReservationTerainController;


use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;




Route::get('/loginAdmin',[LoginAdminController::class,'index'])->name('loginadmin');
Route::post('/Access_to_acount_admin',[LoginAdminController::class,'accesMyadminAccount']);


Route::group(['middleware' => 'auth.after_admin_login'], function () {


// -----------------------------------Profil-----------------------------------------------

Route::get('/adminProfile/adm={id}',[ProfilController::class,'index']);  
Route::get('/modif_admin_page/adm={id}',[ProfilController::class,'modifpage']);
Route::get('/changerPasswordPage',[ProfilController::class,'changePasswordPage']);
Route::post('/change_admin_password/adm={id}',[ProfilController::class,'changePass']);
Route::post('/modifier_admin_Profil/adm={id}',[ProfilController::class,'save_changes']);
Route::get('/deconexion',[ProfilController::class,'deconex']);


// -----------------------------------Dashboard-----------------------------------------------

Route::get('/admin',[DashboardAdminController::class,'index']);
Route::get('/get_chart_global_data',[DashboardAdminController::class,'chartGlobal']);
Route::get('/get_chart_terain_data',[DashboardAdminController::class,'chartTerain']);
Route::get('/get_chart_salle_data',[DashboardAdminController::class,'chartSalle']);
Route::get('/get_chart_materiel_data',[DashboardAdminController::class,'chartMateriel']);

// -----------------------------------Materiel-----------------------------------------------

Route::get('/materiel_est',[MaterielController::class,'show_materiel']);

Route::post('/save-materiel',[MaterielController::class,'save_materiel']);

Route::get('/get_materiel_edited_data',[MaterielController::class,'get_materiel_edited']);

Route::put('/update-materiel/vbgf={id}',[MaterielController::class,'update_materiel']);

Route::delete('/delete-materiel/yxkpq={id}',[MaterielController::class,'delete_materiel']);

Route::get('/search-materiel',[MaterielController::class,'search_materiel']);

// -----------------------------------Evenements-----------------------------------------------

Route::get('/evenement_est',[EvenmentController::class,'showEvents']);

Route::post('/add_event',[EvenmentController::class,'addEvent']);

Route::delete('/delete_event/id={id}',[EvenmentController::class,'deleteEvent']);

Route::get('/search-event',[EvenmentController::class,'searchEvent']);

// -----------------------------------Terains-----------------------------------------------

Route::get('/terain_est',[TerainController::class,'showTerains']);

Route::post('/save-terain',[TerainController::class,'addTerain']);

Route::post('/edit-terain/id={id}',[TerainController::class,'editTerain']);

Route::get('/get_terain_edited_data',[TerainController::class,'get_terain_data']);

Route::delete('/delete-terain/id={id}',[TerainController::class,'delete_terain']);

// -----------------------------------Salle-----------------------------------------------

Route::get('/salle_est',[SalleController::class,'showsalles']);

Route::post('/save-salle',[SalleController::class,'addsalle']);

Route::post('/edit-salle/id={id}',[SalleController::class,'editsalle']);

Route::get('/get_salle_edited_data',[SalleController::class,'get_salle_data']);

Route::delete('/delete-salle/id={id}',[SalleController::class,'delete_salle']);

// -----------------------------------Resérvations Terain-----------------------------------------------

Route::get('/reservationTerain',[ReservationTerainController::class,'index']);

Route::get('/reservation_data',[ReservationTerainController::class,'get_data_reserv']);

Route::get('/reservation_data/id={id}',[ReservationTerainController::class,'get_data_reserv_user']);

// -----------------------------------Resérvations Matériel-----------------------------------------------

Route::get('/reservationMateriel',[ReservationMaterielController::class,'index']);

Route::get('/reservation_data_materiel',[ReservationMaterielController::class,'get_data_reserv']);

Route::get('/reservation_data_materiel/id={id}',[ReservationMaterielController::class,'get_data_reserv_user_materiel']);

Route::get('/demandes_reserv_materiel',[ReservationMaterielController::class,'demandes_reserve']);

Route::get('/demandes_reserv_materiel_after',[ReservationMaterielController::class,'demandes_reserve_after']);

// -----------------------------------Resérvations Salle-----------------------------------------------

Route::get('/reservationSalle',[ReservationSalleController::class,'index']);

Route::get('/reservation_data_salle',[ReservationSalleController::class,'get_data_reserv']);

Route::get('/reservation_data_salle/id={id}',[ReservationSalleController::class,'get_data_reserv_user_salle']);

Route::get('/demandes_reserv_salle',[ReservationSalleController::class,'demandes_reserve']);

Route::get('/demandes_reserv_salle_after',[ReservationSalleController::class,'demandes_reserve_after']);


// -----------------------------------Utilisateurs-----------------------------------------------

Route::get('/users_est',[UserController::class,'index']);
Route::post('/notify_Utilisateur/yxkpq={id}&id2={id2}',[UserController::class,'notify_user']);
Route::get('/search-users',[UserController::class,'search_user']);
Route::post('/createUserAcount',[UserController::class,'addUser']);


});



// ------------compte utilisateur-------------------------------


// Login
Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/Access_to_acount',[LoginController::class,'access_to_my_acount']);


Route::group(['middleware' => 'auth.after_login'], function () {
// begin middlware user




// Profil
// --------------------------------------------------------------------------------------------------
Route::get('/monprofil/id={id}',[UserProfilController::class,'index']);
Route::get('/editProfil/id={id}',[UserProfilController::class,'editProfilPage']);
Route::post('/saveChangeProfil/id={id}',[UserProfilController::class,'saveChanging']);

// password
// --------------------------------------------------------------------------------------------------
Route::get('/changepassword',[UserManagePasswordController::class,'index']);
Route::post('/savechangepassword/id={id}',[UserManagePasswordController::class,'savechangedpassword']);


// Log out
// --------------------------------------------------------------------------------------------------
Route::get('/deconexion',[LogoutController::class,'logout']);


// Acceuill
// --------------------------------------------------------------------------------------------------
Route::get('/',[DashboardController::class,'index']);
Route::get('/togetEvent/id={id}&nb={nb}',[DashboardController::class,'myoneEvent']);

// Help
//----------------------------------------------------------------------------
Route::get('/faqs',[UserfaqsController::class,'faqs']);


// reservationTerain
// --------------------------------------------------------------------------------------------------
Route::get('/userReserveTerain',[UserReservationTerainController::class,'reserve']);
Route::get('/next_to_reservation_terain/id={id}',[UserReservationTerainController::class,'next_to_terain_reserve']);
Route::get('/check_date',[UserReservationTerainController::class,'check_available_hours']);
Route::post('/userReserveTerain/jereserve/id={id}&id2={id2}',[UserReservationTerainController::class,'jereserve']);
Route::get('reservationTerain_Status',[UserReservationTerainController::class,'reservationStatus']);


// reservationMateriel
// --------------------------------------------------------------------------------------------------
Route::get('/userReserveMateriel',[UserReservationMaterielController::class,'reserve']);
Route::post('/next_after_chosing_material',[UserReservationMaterielController::class,'next_to_material_date_reserve']);
    Route::get('/check_timeReserv',[UserReservationMaterielNextController::class,'check_available_hours_Materl']);
    Route::get('/retrieve_timeReservEnd',[UserReservationMaterielNextController::class,'retrieve_available_hoursA_Materl']);
    Route::get('/retieve_quantite',[UserReservationMaterielNextController::class,'retrieve_availabel_quantite_in_reserved_hours']);
    Route::post('/userReserveMateriel/jereserve/id={id}&id2={id2}',[UserReservationMaterielNextController::class,'materiel_date_reserev']);
Route::get('/reservation_Status',[UserReservationMaterielController::class,'reserveStatus']);

// reservationSalle
// --------------------------------------------------------------------------------------------------
Route::get('/userReserveSalle',[UserReservationSalleController::class,'reserve']);
Route::get('/next_to_reservation_salle/id={id}',[UserReservationSalleController::class,'next_to_salle_reserve']);
Route::get('/retrieve_salle_heureDe_reserv',[UserReservationSalleController::class,'retrieve_salle_heureDe_reserv']);
Route::get('/retrieve_salle_heureA_reserv',[UserReservationSalleController::class,'retrieve_salle_heureA_reserv']);
Route::post('/userReserveSalle/jereserve/id={id}&id2={id2}',[UserReservationSalleController::class,'salle_date_reserve']);
Route::get('/reservationSalle_Status',[UserReservationSalleController::class,'reservationStatus']);


// mesreservation
// -------------------------------------------------------------------------------------------------
Route::get('/mesreservations',[MyreservationsController::class,'myreserve']);
Route::get('/retrieve_mesReservation_data',[MyreservationsController::class,'retrieve_mesreservation']);


// mesnotifications
//--------------------------------------------------------------------------------------------------
Route::get('/mesnotifications/do={id}',[UserNotificationController::class,'mynotif']);






// end middlware user
});






