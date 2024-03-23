<?php

namespace App\Http\Controllers\UserReservationMateriel;

use App\Http\Controllers\Controller;
use App\Models\DynamiqueQuantite;
use App\Models\Materiel;
use App\Models\Reservationm;
use Carbon\Carbon;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class UserReservationMaterielController extends Controller
{
    public function reserve(){
        $materiels = Materiel::where('quantite','>',0)->get();
        $progress = 33;

        return view('user.resrveMaterielFolder.resrveMateriel',compact('materiels','progress'));

    }
// --------------------------------------------Function separator---------------------------------------------------------------------   

public function next_to_material_date_reserve(Request $request){
    // $materiel_chosen = Materiel::where('id','=',$request->input('materiel'))->first(); //imkn nst3ml first 3iwad get bax may3tinix array
    $progress = 66;
    return view('user.resrveMaterielFolder.reserveMaterieNext',compact('progress'))->with('matId',$request->input('materiel'));


}

// --------------------------------------------Function separator---------------------------------------------------------------------   

public function reserveStatus(){
    
    return view('user.resrveMaterielFolder.reservationStatus');
}

}
