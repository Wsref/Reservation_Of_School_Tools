<?php

namespace App\Http\Controllers;

use App\Models\messages;
use App\Models\individuals;
use App\Models\Reservationm;
use Illuminate\Http\Request;
use App\Models\material_borrow;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\messagesController;

// use view;

class material_borrowController extends Controller
{
      //
      public function getBorrows()
      {
          $data = material_borrow::all();
          return response()->json($data);
      }

      public function getBorrowsHtml($id)
    {
    $borrows = DB::select('select * from material_borrow where userId = ?',[$id]); // Retrieve borrows from the database or wherever
    // $Mat_reservs = DB::select(' select * from reservationms where user_id = ? order by date_reserve desc ' , [$id]);
    $Mat_reservs = Reservationm::with('materiels')->where('user_id', $id)->orderByDesc('date_reserve')->get();
    // $Mat_reservs = Reservationm::all();
    
    return View::make('components.userBorrow', ['borrows' => $borrows ,'Mat_reservs'=>$Mat_reservs])->render();
    }   
    
    public function getBorrowChartsHtml()
    {
    $borrows = material_borrow::all(); // Retrieve borrows from the database or wherever
    // material_borrow::
    
    return View::make('components.userBorrowcharts', ['borrows' => $borrows])->render();
    }   
    
    public function load_UsermsgBox($id)
    {
        // $data = individuals::find($id);
        $msgdata = DB::select('select * from messages where sender_id = ? or receiver_id = ?', [$id,$id]);
        $user = individuals::find($id);

        return View::make('components.UsermessagesBox', ['msgdata' => $msgdata , 'user' => $user])->render();

    }

        
    public function load_UserData($id)
    {
        $data = individuals::find($id);

        return View::make('components.UserGeneralData', ['user' => $data])->render();

    }

}
