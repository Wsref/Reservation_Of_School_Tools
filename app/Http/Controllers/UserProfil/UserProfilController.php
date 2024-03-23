<?php

namespace App\Http\Controllers\UserProfil;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfilController extends Controller
{
    public function index($id){

        $monprfil = User::where('id','=',$id)->first();
        $usertype = "Normal";
        if($monprfil->usertype){$usertype = "Adhérant";}

        $profil_data = ['user_prenom' => $monprfil->prenom,'user_nom' => $monprfil->nom,
                        'user_email' => $monprfil->email,'user_telephone' => $monprfil->telephon,
                        'user_filiere' => $monprfil->filiere,'user_annee' => $monprfil->anne,
                        'user_category' => $usertype];

        return view('user.profilFolder.monprofil',compact('profil_data'));

    }

    public function editProfilPage($id){

        $monprfil = User::where('id','=',$id)->first();
        $usertype = "Normal";
        if($monprfil->usertype){$usertype = "Adhérant";}

        $profil_data = ['user_prenom' => $monprfil->prenom,'user_nom' => $monprfil->nom,
                        'user_email' => $monprfil->email,'user_telephone' => $monprfil->telephon,
                        'user_filiere' => $monprfil->filiere,'user_annee' => $monprfil->anne,
                        'user_category' => $usertype];

        return view('user.profilFolder.editprofil',compact('profil_data'));

    }

    public function saveChanging(Request $request,$id){
        $monprofil = User::where('id','=',$id)->first();

        $monprofil->email = $request->input('email');
        $monprofil->telephon = $request->input('telephone');
        $monprofil->save();

        $request->session()->flush();
        return redirect()->route('login');

    }
}
