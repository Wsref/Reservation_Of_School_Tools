<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminMessage;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::paginate(10);

        return view('admin.user.users_est',compact('users'));
    }

    public function notify_user(Request $request,$id,$id2){
        $adminMessage = new AdminMessage();
        $adminMessage->admin_id = $id2;
        $adminMessage->user_id = $id;
        $adminMessage->message = $request->input('message');
        $adminMessage->save();
        return redirect()->back()->with('notifySuccess',"Notification bien envoyé");

    }

    public function search_user(Request $request){
        $outup = "";
        $users = User::where('prenom','Like','%'.$request->search.'%')->orWhere('nom','Like','%'.$request->search.'%')->paginate('10');

        foreach($users as $user){
            $outup.= '
                <tr>
                    <td>'.$user->prenom.'</td>
                    <td>'.$user->nom.'</td>
                    <td>'.$user->filiere.'</td>
                    <td>'.$user->anne.'</td>
                    <td>'.$user->email.'</td>
                    <td>'.$user->telephon.'</td>
                    <td>
                    '.'
                        <button type="button" class="btn btn-sm btn-warning notifybtn" data-bs-toggle="modal" data-bs-target="#notifModal" value="'.$user->id.'">
                        '.'Notifier</button>'.'
                    </td>
                </tr>

            ';
            
        }

        return response()->json([
            'data' => $outup,
            'userIds' => $users->pluck('id')
        ]);
    }

    public function addUser(Request $request){
        $new_user = new User();

        $new_user->prenom = $request->input('prenm');
        $new_user->nom = $request->input('nm');
        $new_user->filiere = $request->input('filir');
        $new_user->anne = $request->input('ann');
        $new_user->email = $request->input('eml');
        $new_user->telephon = $request->input('telp');
        $new_user->password = $request->input('psswrd');

        $new_user->save();
        $msg = 'Compte de '.$request->input('prenm').' bien crée';
        return redirect()->back()->with('createSuc',$msg);

    }
}
