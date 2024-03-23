<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Terain;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Http\Request;

class TerainController extends Controller
{
    public function showTerains(){
        $myTerain = Terain::paginate(1);
        return view('admin.terain.terain',compact('myTerain'));
    }

    // ----------------------------------------------------------------------------------

    public function addTerain(Request $request){
        $newTerain = new Terain();
        $newTerain->nom = $request->input('nom');

        if($request->hasFile('image')){
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('myImg/terains',$filename);
            $newTerain->image = $filename;
        }

        $newTerain->gazon = $request->input('gazon');
        $newTerain->surface = $request->input('larg') . "m x ". $request->input('long') . "m";
        $newTerain->description = $request->input('descript');
        $newTerain->save();

        return redirect('/terain_est');

    }

    // ----------------------------------------------------------------------------------

    public function get_terain_data(Request $request){
        $myTerain = Terain::where('id','=',$request->terainId)->first();
        $nom = $myTerain->nom;
        $gazon = $myTerain->gazon;
        $surface = $myTerain->surface;
        $descript = $myTerain->description;

        return response()->json(['nom'=>$nom,'gazon'=>$gazon,
                                'surface'=>$surface,'descript'=>$descript]);


    }

    // ----------------------------------------------------------------------------------

    public function editTerain(Request $request,$id){
        $myTerain = Terain::where('id','=',$id)->first();
        $nomTr = $myTerain->nom;
        $myTerain->nom = $request->input('nom');
        
        if($request->hasFile('image')){
            $my_old_img_path = 'myImg/terains/' . $myTerain->image;
            if(FacadesFile::exists($my_old_img_path)){
                FacadesFile::delete($my_old_img_path);
            }
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('myImg/terains/',$filename);
            $myTerain->image = $filename;
        }

        if($request->input('larg') && $request->input('long') ){
            $myTerain->surface = $request->input('larg') ."m x ".$request->input('long')."m";
        }

        $myTerain->gazon = $request->input('gazon');
        $myTerain->description = $request->input('descript');

        $myTerain->save();

        $status = '"'.$nomTr.'"'.' bien modifié';
        return redirect('/terain_est')->with('EditTerainStatus',$status);


    }

    // ----------------------------------------------------------------------------------

    public function delete_terain($id){
        $terain = Terain::where('id','=',$id)->first();
        $nomTr = $terain->nom;
        $terain->delete();
        $status = '"'.$nomTr.'"'.' bien supprimé';
        return redirect('/terain_est')->with('EditTerainStatus',$status);
    }
}
