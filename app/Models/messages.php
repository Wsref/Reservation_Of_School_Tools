<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class messages extends Model
{
    use HasFactory;
    public $timestamps = false;

    // DB::select('select * from users where active = ?', [1]);
    // DB::select('select * from users where active = ?');
    public static function getUsermsgs($id)
    {
        $msgdata = DB::select('select * from messages where sender_id = ? or receiver_id = ?', [$id,$id]);
        // $user = individuals::find($id);

        // return View::make('components.UsermessagesBox', ['msgdata' => $msgdata , 'user' => $user])->render();
        return $msgdata;
    }
}
