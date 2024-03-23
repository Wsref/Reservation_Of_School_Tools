<?php

namespace App\Http\Controllers\Authentification;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Evenement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(Request $request){
        // 
        $theAdmin = Admin::first();
        $request->session()->put('numeroAdmin',$theAdmin->telephone);
        return view('authentification.login');
    }

    public function access_to_my_acount(Request $request){

        $the_user = User::where('email','=',$request->input('mymail'))->first();
        $the_latest_event = Evenement::orderBy('date_diffus', 'desc')
                                      ->orderBy('time_diffus', 'desc')->first();
        
        $mypassfromDb = $the_user->password;        
        if(Hash::needsRehash($mypassfromDb)){
            if($the_user && !strcmp($mypassfromDb,$request->input('mypass'))){
                $request->session()->put('user_id',$the_user->id);
                $request->session()->put('prenom',$the_user->prenom);
                $request->session()->put('nom',$the_user->nom);
                $request->session()->put('latestEvent',$the_latest_event->titre);
                
                return redirect('/');
            }
            return redirect()->route('login');
        }else{
            if($the_user && Hash::check($request->input('mypass'), $the_user->password)){
                $request->session()->put('user_id',$the_user->id);
                $request->session()->put('prenom',$the_user->prenom);
                $request->session()->put('nom',$the_user->nom);
                $request->session()->put('latestEvent',$the_latest_event->titre);
                
                return redirect('/');
                }
            return redirect()->route('login');
        }
        
        

    }
}
