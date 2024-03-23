<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DynamiqueQuantite;
use App\Models\Materiel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FacadesFile;

class MaterielController extends Controller
{

    public function show_materiel(){
        $materiels = Materiel::all();
        $dynQuantities = DynamiqueQuantite::where('date_reserve','=',date('Y-m-d'))->orderBy('time_reserve')->paginate(8);
        if(count($dynQuantities)<=0){
            return view('admin.materiel.materiel',compact('materiels','dynQuantities'))->with('dynQuantVid','Pas de données a afficher');
        }
        return view('admin.materiel.materiel',compact('materiels','dynQuantities'));
        
    }

    // -------------------------------------------------------------

    public function save_materiel(Request $request){
        $new_materiel = new Materiel();
        $new_materiel->name = $request->input('nom');

        // $new_materiel->image = $request->input('');
        if($request->hasFile('image')){
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('myImg/materiels',$filename);
            $new_materiel->image = $filename;
        }


        $new_materiel->category = $request->input('category');
        $new_materiel->quantite = $request->input('quantite');
        $new_materiel->save();

        return redirect('/materiel_est')->with('status','Ajouté avec succes');
    }

    // -------------------------------------------------------------

    public function update_materiel(Request $request,$id){
        $materiel = Materiel::find($id);
        $materiel->name = $request->input('nom');
        if($request->hasFile('image')){

            $my_old_img_path = 'myImg/materiels/' . $materiel->image;
            if(FacadesFile::exists($my_old_img_path)){
                FacadesFile::delete($my_old_img_path);
            }

            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('myImg/materiels',$filename);
            $materiel->image = $filename;
        }
        $materiel->category = $request->input('category');
        $materiel->quantite = $request->input('quantite');



        $materiel->update();

        return redirect('/materiel_est')->with('status','Edité avec succes');
    }

    // -------------------------------------------------------------

    public function delete_materiel($id){
        $materiel = Materiel::find($id);
        $materiel->delete();
        return redirect()->back()->with('status','supprimé avec success');
    }

    // -------------------------------------------------------------

    public function search_materiel(Request $request){
        $outup = "";
        $materiel = Materiel::where('name','Like','%'.$request->search.'%')
                             ->orWhere('category','Like','%'.$request->search.'%')
                             ->orWhere('quantite','Like','%'.$request->search.'%')
                             ->get();

        foreach($materiel as $materl){
            $outup.= '
                <tr>
                    <td>'.$materl->name.'</td>
                    <td>'.$materl->category.'</td>
                    <td>'.$materl->quantite.'</td>
                    <td>
                    '.'
                        <button type="button" class="btn btn-sm btn-primary editbtn" data-bs-toggle="modal" data-bs-target="#editModal" value="'.$materl->id.'">
                        '.'Editer</button>'.'
                    </td>
                    <td>
                    '.'
                        <button type="button" class="btn btn-sm btn-danger deletebtn" data-bs-toggle="modal" data-bs-target="#deletModal" value="'.$materl->id.'">
                        '.'Supprimer</button>'.'
                    </td>
                </tr>

            ';
            
        }

        return response()->json([
            'data' => $outup ,
            'materilIds' => $materiel->pluck('id')
        ]);

    }

    // -------------------------------------------------------------------------------------------------

    public function get_materiel_edited(Request $request){
        $myMateriel = Materiel::where('id','=',$request->materielId)->first();
        $nom  = $myMateriel->name;
        $category = $myMateriel->category;
        $quantite = $myMateriel->quantite;
        $image = $myMateriel->image;

        return response()->json(['nom'=>$nom,'category'=>$category,'quantite'=>$quantite,'image'=>$image]);
    }


}
