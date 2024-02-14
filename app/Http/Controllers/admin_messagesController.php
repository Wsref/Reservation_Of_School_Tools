<?php

namespace App\Http\Controllers;

use App\Models\individuals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class admin_messagesController extends Controller
{
    //
    // public function load_UsermsgBox($id)
    // {
    //     // $data = individuals::find($id);
    //     $msgdata = DB::select('select * from messages where sender_id = ? or receiver_id = ?', [$id,$id]);
    //     $user = individuals::find($id);

    //     return View::make('components.UsermessagesBox', ['msgdata' => $msgdata , 'user' => $user])->render();

    // }
}
