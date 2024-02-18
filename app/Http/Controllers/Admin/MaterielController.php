<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Materiel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FacadesFile;

class MaterielController extends Controller
{
    public function show_materiel(){
        $materiels = Materiel::paginate('4');

        return view('admin.materiel.materiel',compact('materiels'));
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
            $file->move('uploads/imgs',$filename);
            $new_materiel->image = $filename;
        }


        $new_materiel->category = $request->input('category');
        $new_materiel->quantite = $request->input('quantite');
        $new_materiel->save();

        return redirect('/materiel_est')->with('status','Ajouté avec succes');
    }

    // -------------------------------------------------------------

    public function edit_materiel($id){
        $edit_materiel = Materiel::find($id);
        return view('admin.materiel.materiel-edit',compact('edit_materiel'));
    }

    // -------------------------------------------------------------

    public function update_materiel(Request $request,$id){
        $materiel = Materiel::find($id);
        $materiel->name = $request->input('nom');
        if($request->hasFile('image')){

            $my_old_img_path = 'uploads/imgs/' . $materiel->image;
            if(FacadesFile::exists($my_old_img_path)){
                FacadesFile::delete($my_old_img_path);
            }

            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('uploads/imgs',$filename);
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
        $materiel = Materiel::where('name','Like','%'.$request->search.'%')->orWhere('category','Like','%'.$request->search.'%')->paginate('4');

        foreach($materiel as $materl){
            $outup.= '
                <tr>
                    <td>'.$materl->name.'</td>
                    <td>'.$materl->category.'</td>
                    <td>'.$materl->quantite.'</td>
                    <td>'.$materl->updated_at.'</td>
                    <td>
                    '.'
                        <a href="/edit-materiel/yxwiu=' .$materl->id.'" class="btn btn-sm btn-secondary">
                        '.'Editer</a>'.'
                    </td>
                    <td>
                    '.'
                        <button type="button" class="btn btn-sm btn-secondary deletebtn" data-bs-toggle="modal" data-bs-target="#deletModal" data-bs-materiel-id="'.$materl->id.'">
                        '.'Supprimer</button>'.'
                    </td>
                </tr>

            ';
        }

        return response()->json([
            'pagination' => $materiel->links()->toHtml(), 
            'data' => $outup ,
            'materilIds' => $materiel->pluck('id')
        ]);

    }


}
