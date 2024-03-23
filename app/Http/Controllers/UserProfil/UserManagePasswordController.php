<?php

namespace App\Http\Controllers\UserProfil;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagePasswordController extends Controller
{
    public function index(){
        return view('user.profilFolder.editpassword');
    }

    public function savechangedpassword(Request $request,$id){
        $monprofil = User::where('id','=',$id)->first();

        if(!strcmp($request->input('actpass'),$monprofil->password)){
            $monprofil->password = $request->input('pass');
            $monprofil->save();
            $request->session()->flush();
            return redirect()->route('login');
        }else{
            return redirect()->back()->with('NV',"password actuel n'est pas vrai.");
        }
    }
}
