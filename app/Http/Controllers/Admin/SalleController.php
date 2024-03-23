<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Salle;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Http\Request;

class SalleController extends Controller
{
    public function showsalles(){
        $mySalle = Salle::paginate(1);
        return view('admin.salle.salle',compact('mySalle'));
    }

    // ----------------------------------------------------------------------------------

    public function addsalle(Request $request){
        $newTerain = new Salle();
        $newTerain->nom = $request->input('nom');

        if($request->hasFile('image')){
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('myImg/salles',$filename);
            $newTerain->image = $filename;
        }

        $newTerain->capacity = $request->input('capacite');
        $newTerain->description = $request->input('descript');
        $newTerain->save();

        return redirect('/salle_est');

    }

    // ----------------------------------------------------------------------------------

    public function get_salle_data(Request $request){
        $mySalle = Salle::where('id','=',$request->salleId)->first();
        $nom = $mySalle->nom;
        $capacity = $mySalle->capacity;
        $descript = $mySalle->description;

        return response()->json(['nom'=>$nom,'capacity'=>$capacity,
                                'descript'=>$descript]);


    }

    // ----------------------------------------------------------------------------------

    public function editsalle(Request $request,$id){
        $myTerain = Salle::where('id','=',$id)->first();
        $nomTr = $myTerain->nom;
        $myTerain->nom = $request->input('nom');
        
        if($request->hasFile('image')){
            $my_old_img_path = 'myImg/salles/' . $myTerain->image;
            if(FacadesFile::exists($my_old_img_path)){
                FacadesFile::delete($my_old_img_path);
            }
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('myImg/salles/',$filename);
            $myTerain->image = $filename;
        }


        $myTerain->capacity = $request->input('capacite');
        $myTerain->description = $request->input('descript');

        $myTerain->save();

        $status = '"'.$nomTr.'"'.' bien modifié';
        return redirect('/salle_est')->with('EditSalleStatus',$status);


    }

    // ----------------------------------------------------------------------------------

    public function delete_salle($id){
        $terain = Salle::where('id','=',$id)->first();
        $nomTr = $terain->nom;
        $terain->delete();
        $status = '"'.$nomTr.'"'.' bien supprimé';
        return redirect('/salle_est')->with('EditSalleStatus',$status);
    }
}
