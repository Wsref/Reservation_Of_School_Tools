<?php

namespace App\Http\Controllers;

use App\Models\messages;
use App\Models\individuals;
use App\Models\Reservationm;
use Illuminate\Http\Request;
use App\Models\user_messages;
use App\Models\admin_messages;
use App\Models\material_borrow;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Symfony\Component\VarDumper\VarDumper;

class individuaController extends Controller
{
    //
    public function usersview()
    {
        $users = individuals::all();
        $borrows = material_borrow::all();
        $Mat_reservs = Reservationm::all();

        return view('usersview' , ['users'=>$users ,
        'borrows' => $borrows ,
    'Mat_reservs'=>$Mat_reservs]);

    }


    public function getindividualData()
    {
        $data = individuals::all();
        return response()->json($data);
    }


    public function filterANDreload(Request $request)
    {
                // Start building the query
                $query = individuals::query(); 

        // dd($request->all());
        foreach ($request->all() as $propertyName => $propertyarray) {    
            // Check if the value is an array
            // dd($propertyarray);
            if (is_array($propertyarray)) {
                // Add a whereIn condition for the array of values
                $query->whereIn($propertyName, $propertyarray);
            }
        }

        Log::info('Generated SQL:', [
            'query' => $query->toSql(),
            'bindings' => $query->getBindings(),
        ]);
        
                // Execute the query and retrieve the results
                // $users = $query->get(['id', 'fname', 'pname', 'year', 'branch','email','password'])->toArray();        
                // $users = $query->get(['id', 'fname', 'pname', 'year', 'branch']);

                // $users = $users->map(function ($user) {
                //     return $user->toArray();
                // })->toArray();

                $userscoll = $query->get(['id', 'fname', 'pname', 'year', 'branch','email','password']);
                $users = [];

                foreach ($userscoll as $user) 
                {
                        // Debugging: Log the user data
                    Log::info('$user==>  :', $user->toArray());
                    $userArray =  $user->toArray(); // Convert stdClass object to array
                    // Log::info('$userArray===>', $userArray);
                    $users[] = $userArray;
                }
                Log::info('$user[]==>  :', $users);

                $borrows = material_borrow::all();
                $Mat_reservs = Reservationm::all();

                // Process and return the results as needed
                // var_dump($users);
                return View::make('components.user', ['users' => $users , 'borrows'=>$borrows,'Mat_reservs'=>$Mat_reservs])->render();
        
    }

    public function userdata($id)
    {
        $user= individuals::find($id);
        $user_requests_data = DB::select('select * from user_messages where requester_id = ? ', [$id]);
        $borrows0= material_borrow::all();
        $borrows= DB::select('select * from material_borrow where userId = ?',[$id]);
        // $Mat_reservs = DB::select(' select * from reservationms where user_id = ? order by date_reserve desc ' , [$id]);
        $Mat_reservs = Reservationm::with('materiels')->where('user_id', $id)->orderByDesc('date_reserve')->get();

    return view('user' , ['user'=>$user ,
     'user_requests_data' => $user_requests_data ,
     'borrows0'=>$borrows0,
     'borrows'=>$borrows,
    'Mat_reservs'=>$Mat_reservs]);
    }

    public function render_Chat($id)
    {
        $users = individuals::all();
        $user = individuals::find($id) ;
    $msgdata= messages::getUsermsgs($id) ; //!!! tan9iya
    $user_requests_data = DB::select('select * from user_messages where requester_id = ? ', [$id]);
    $admin_replies_data = DB::select('select * from admin_messages where replies_to_id = ? ', [$id]);
    // $chatData = DB::select('select  request_id ,0 as reply_id ,requester_id ,0 as replier_id ,0 as replies_to_request_id ,request_msg as msg ,request_status as status ,request_date as msg_date ,request_time as msg_time, "user" as owner  from user_messages where requester_id = ?
    //     union
    //     select 0 as request_id ,reply_id ,0 as requester_id ,replier_id ,replies_to_request_id ,reply_msg as msg ,response_status as status ,reply_date as msg_date ,reply_time as msg_time , "admin" as owner from admin_messages where replies_to_id= ? ' , [$id,$id]);
        



$chatData = Reservationm::select(
    'id',
    DB::raw('0 as reply_id'),
    'user_id',
    DB::raw('0 as replier_id'),
    DB::raw('0 as replies_to_request_id'),
    DB::raw('(SELECT name FROM materiels WHERE reservationms.materiel_id = materiels.id) as msg'),
    'valide as status',
    'date_reserve as msg_date',
    DB::raw('"06:04:07" as msg_time'), //! need time
    DB::raw('"user" as owner')
)
->where('user_id', $id)
->union(
    admin_messages::select(
        DB::raw('0 as request_id'),
        'reply_id',
        DB::raw('0 as requester_id'),
        'replier_id',
        'replies_to_request_id',
        'reply_msg as msg',
        'response_status as status',
        'reply_date as msg_date',
        'reply_time as msg_time',
        DB::raw('"admin" as owner')
    )
    ->where('replies_to_id', $id)
)
->orderBy('msg_date', 'asc')->orderBy('msg_time', 'asc')
->get();

        return view('chat',
        ['users'=> $users,
        'user'=>$user,
        'msgdata'=>$msgdata,
        'user_requests_data'=>$user_requests_data,
        'admin_replies_data'=>$admin_replies_data,
        'chatData'=>$chatData]);
     
    }
    
}
