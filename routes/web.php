<?php

use App\Models\messages;
use App\Models\individuals;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\messagesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\individuaController;
use App\Http\Controllers\material_borrowController;
use App\Models\material_borrow;

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
    return view('usersview',['users'=> individuals::all(),'borrows'=>material_borrow::all()]);
});
Route::get('/reLoad_filtered_Users', [individuaController::class,'filterANDreload']);


Route::get('/users/{id}', function ($id) {
    return view('user',['user'=> individuals::find($id),
                        'user_requests_data' => DB::select('select * from user_messages where requester_id = ? ', [$id]),
                        'borrows'=>material_borrow::all()]
                    );
});




Route::get('/get-borrows',[material_borrowController::class,'getBorrows']);

Route::get('/get-borrows-html',[material_borrowController::class,'getBorrowsHtml']);

Route::get('/get-borrows-chart-html',[material_borrowController::class,'getBorrowChartsHtml']);

//! chat part routes
Route::get('/users/{id}/chat', function ($id) {
    return view('chat',
    ['users'=>individuals::all() ,
    'user'=> individuals::find($id) ,
    'msgdata'=> messages::getUsermsgs($id) ,
    'user_requests_data' => DB::select('select * from user_messages where requester_id = ? ', [$id]),
    'admin_replies_data' => DB::select('select * from admin_messages where replies_to_id = ? ', [$id]),
    'chatData' => DB::select('select  request_id ,0 as reply_id ,requester_id ,0 as replier_id ,0 as replies_to_request_id ,request_msg as msg ,request_status as status ,request_date as msg_date ,request_time as msg_time, "user" as owner  from user_messages where requester_id = ?
        union
        select 0 as request_id ,reply_id ,0 as requester_id ,replier_id ,replies_to_request_id ,reply_msg as msg ,response_status as status ,reply_date as msg_date ,reply_time as msg_time , "admin" as owner from admin_messages where replies_to_id= ? ' , [$id,$id])
        
     ] );
});

// Route::get('/load-UsermsgBox/{id}',[material_borrowController::class,'load_UsermsgBox']);
// Route::get('/load-UsermsgBox/{id}',[messagesController::class,'load_UsermsgBox']);
//TODO in fact we should include  correspondant admin id to get data , but we'll rely on one with id 1 from now
// id will be passed automatically since the method has that parameter
Route::get('/load-UserData/{id}',[material_borrowController::class,'load_UserData']);

// Define routes for handling AJAX requests
// Route::get('/load-component-1', [YourController::class, 'loadComponent1']);
Route::get('/load-UsermsgBoxAJAX/{id}',[messagesController::class,'load_UsermsgBoxAJAX']);
// update on table
Route::put('/update/{id}', [messagesController::class,'update'])->name('update');
//getting requester_id
// Route::get('/get-data/{requester_id}', 'messagesController@getData' , [messagesController::class,''])->name('get_requester_id');

Route::get('/get-data/{request_id}', function($request_id) {
    // Retrieve data from database or any other source
    // $requester = individuals::find($requester_id); // Retrieve your data here
    $requester = DB::select('select * from user_messages where request_id= ?', [$request_id]);


    return response()->json($requester);
})->name('get_requester_id');

