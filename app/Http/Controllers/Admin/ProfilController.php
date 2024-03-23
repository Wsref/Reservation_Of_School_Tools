<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{

    public function index($id){
        $myadmin = Admin::where('id','=',$id)->first();
        $adminInfo = ['Adminprenom'=>$myadmin->prenom,'Adminnom'=>$myadmin->nom,
                      'Adminemail'=>$myadmin->email,'AdminTelephon'=>$myadmin->telephone,
                      'AdminFacebook'=>$myadmin->facebook,'AdminInstagram'=>$myadmin->instagram];

        return view('admin.profil.profil',compact('adminInfo'));
    }


    public function modifpage($id){

        $myadmin = Admin::where('id','=',$id)->first();
        $adminInfo = ['Adminprenom'=>$myadmin->prenom,'Adminnom'=>$myadmin->nom,
                      'Adminemail'=>$myadmin->email,'AdminTelephon'=>$myadmin->telephone,
                      'AdminFacebook'=>$myadmin->facebook,'AdminInstagram'=>$myadmin->instagram];

        return view('admin.profil.modifProfil',compact('adminInfo'));
    }

    public function save_changes(Request $request,$id){
        $myadmin = Admin::where('id','=',$id)->first();

        $myadmin->prenom = $request->input('prenm');
        $myadmin->nom = $request->input('nm');
        $myadmin->telephone = $request->input('telep');
        $myadmin->facebook = $request->input('fcbk');
        $myadmin->instagram = $request->input('insta');

        $myadmin->save();

        return redirect('/adminProfile/adm='.$id);

    }

    public function changePasswordPage(){

        return view('admin.profil.changPass');
    }

    public function changePass(Request $request,$id){
        $myadmin = Admin::where('id','=',$id)->first();
        $mypassfromDb = $myadmin->password;
        if(Hash::needsRehash($mypassfromDb)){
            if($myadmin && !strcmp($mypassfromDb,$request->input('ancPass'))){
                $password = $request->input('nvPass');
                $hashedPassword = Hash::make($password);
                $myadmin->password = $hashedPassword;
                $myadmin->save();
                $request->session()->flush();
                return redirect()->route('loginadmin');
            }
            return redirect()->back()->with('PassStat',"Incorrect anciene mot de passe");
        }else{
            if($myadmin && Hash::check($request->input('ancPass'), $myadmin->password)){
                $myadmin->password = $request->input('nvPass');
                $myadmin->save();
                $request->session()->flush();
                return redirect()->route('loginadmin');
                }
                return redirect()->back()->with('PassStat',"Incorrect anciene mot de passe");
        }
    }

    public function deconex(Request $request){
        $request->session()->flush();
        return redirect()->route('loginadmin');
    }
}
