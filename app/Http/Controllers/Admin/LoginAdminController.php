<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginAdminController extends Controller
{
    public function index(){
        return view('admin.authentification.login');
    }

    public function accesMyadminAccount(Request $request){
        $the_admin = Admin::where('email','=',$request->input('mymail'))->first();
        $mypassfromDb = $the_admin->password;
        if(Hash::needsRehash($mypassfromDb)){
            if($the_admin && !strcmp($mypassfromDb,$request->input('mypass'))){
                $request->session()->put('admin_id',$the_admin->id);
                $request->session()->put('admin_prenom',$the_admin->prenom);
                return redirect('/admin');
            }
            return redirect()->route('loginadmin');
        }else{
            if($the_admin && Hash::check($request->input('mypass'), $the_admin->password)){
                $request->session()->put('admin_id',$the_admin->id);
                $request->session()->put('admin_prenom',$the_admin->prenom);
                return redirect('/admin');
                }
            return redirect()->route('loginadmin');
        }
        

    }
}
