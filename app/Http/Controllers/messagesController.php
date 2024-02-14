<?php

namespace App\Http\Controllers;

use App\Models\individuals;
use App\Models\user_messages;
use App\Models\admin_messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class messagesController extends Controller
{
    //
    public function load_UsermsgBox($id)
    {
        // $data = individuals::find($id);
        $user_requests_data = DB::select('select * from user_messages where requester_id = ? ', [$id]);
        $admin_replies_data = DB::select('select * from admin_messages where replies_to_id = ? ', [$id]);
        $user = individuals::find($id);
        $chatData = DB::select('select  request_id ,0 as reply_id ,requester_id ,0 as replier_id ,0 as replies_to_request_id ,request_msg as msg ,request_status as status ,request_date as msg_date ,request_time as msg_time, "user" as owner  from user_messages where requester_id = ?
        union
        select 0 as request_id ,reply_id ,0 as requester_id ,replier_id ,replies_to_request_id ,reply_msg as msg ,response_status as status ,reply_date as msg_date ,reply_time as msg_time , "admin" as owner from admin_messages where replies_to_id= ? ' , [$id,$id]);

        // dd($chatData);

        return View::make('components.UsermessagesBox', ['user_requests_data' => $user_requests_data ,'admin_replies_data' => $admin_replies_data , 'user' => $user , 'chatData' => $chatData  ] )->render();

    }

    public function load_UsermsgBoxAJAX($id)
    {
        // $data = individuals::find($id);
        $user_requests_data = DB::select('select * from user_messages where requester_id = ? ', [$id]);
        $admin_replies_data = DB::select('select * from admin_messages where replies_to_id = ? ', [$id]);
        $user = individuals::find($id);
        $chatData = DB::select('select  request_id ,0 as reply_id ,requester_id ,0 as replier_id ,0 as replies_to_request_id ,request_msg as msg ,request_status as status ,request_date as msg_date ,request_time as msg_time, "user" as owner  from user_messages where requester_id = ?
        union
        select 0 as request_id ,reply_id ,0 as requester_id ,replier_id ,replies_to_request_id , "" as msg ,response_status as status ,reply_date as msg_date ,reply_time as msg_time , "admin" as owner from admin_messages where replies_to_id= ? ' , [$id,$id]);

            // Retrieve data for component 2
        // $data = ...; // Fetch data from your database or elsewhere
        
        return response()->json(['component' => view('components.UsermessagesBox', ['user_requests_data' => $user_requests_data ,'admin_replies_data' => $admin_replies_data , 'user' => $user , 'chatData' => $chatData  ])->render()]);

        // return View::make('components.UsermessagesBox', ['user_requests_data' => $user_requests_data ,'admin_replies_data' => $admin_replies_data , 'user' => $user , 'chatData' => $chatData  ] )->render();

    }

    public function update(Request $request, $request_id)
{
    $myrequest = user_messages::findOrFail($request_id, ['request_id']);
    // $reply = DB::select("");


    // Update the specific column based on the request data
    $myrequest->update([
        'request_status' => $request->updateValue
    ]);

    $newreply = new admin_messages();

    // Update or store the data based on the request
    $newreply->replier_id = 1;
    $newreply->replies_to_id = $request->requester_id;
    $newreply->replies_to_request_id = $request->request_id;
    $newreply->reply_msg = $request->reply_msg;
    // $newreply->reply_msg = ;

    // $newreply->reply_msg = $request->has('reply_msg') ? $request->reply_msg : " ";
    $newreply->response_status = $request->updateValue;
    $newreply->reply_date = now()->toDateString();
    $newreply->reply_time = now()->toTimeString();
    $newreply->reply_timestamp = now();

    // Save the model to the database
    $newreply->save();


    // Return a response indicating success or failure
    return response()->json(['message' => 'Update successful'], 200);
    // return redirect()->route('route_to_chat',[$myrequest->requester_id])->with('success', 'Update successful');
}

}

