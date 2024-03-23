<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservationsal;
use Illuminate\Http\Request;

class ReservationSalleController extends Controller
{
    public function index(){
        $curYear = date("Y");
        $curMonth = date("m");
        $curDay = date("d");
        $curDate = $curYear .'-'. $curMonth .'-'. $curDay;
        $curHour = (int) date("H");

        $reservationPasse = Reservationsal::all();
        foreach($reservationPasse as $data){
            $isold = ($this)->isOldDate($curDate,$data->date_reserve,$curHour,$data->time_reserve_end);
            if($isold){
                $data->valide = 0;
                $data->save();
            }
        }
        return view('admin.reservation.reservationsal');
    }
    
    // ---------------my own function to compare between dates--------------
    protected function isOldDate($currDate,$dataDate,$curTime,$dataTime){
            $curYear = (int) explode('-',$currDate)[0];
            $curMonth = (int) explode('-',$currDate)[1];
            $curDay = (int) explode('-',$currDate)[2];
            //----
            $dataYear = (int) explode('-',$dataDate)[0];
            $dataMonth = (int) explode('-',$dataDate)[1];
            $dataDay = (int) explode('-',$dataDate)[2];
            $dataTime = (int) explode(':',$dataTime)[0];
            //----
            $yearComp = $curYear - $dataYear;
            $monthComp = $curMonth - $dataMonth;
            $dayComp = $curDay - $dataDay;
            $timeComp = $curTime - $dataTime;

            if($yearComp>0){
                return 1;
            }elseif($yearComp==0){
                if($monthComp>0){
                    return 1;
                }elseif($monthComp==0){
                    if($dayComp>0){
                        return 1;
                    }elseif($dayComp==0){
                        if($timeComp>=0){
                            return 1;
                        }else{
                            return 0;
                        }
                    }else{
                        return 0;
                    }

                }else{
                    return 0;
                }
            }else{
                return 0;
            }



    }

    // ------------------------------------separate functions-----------------------------------------------------

    public function get_data_reserv(){
        $reservations = Reservationsal::all();
        $reservData = [];
    
        foreach ($reservations as $reserv) {
            if($reserv->valide<0) $color = "orange";
            elseif($reserv->valide==0) $color="red";
            else $color="blue";
            $reservData[] = [
                'title' => $reserv->users->prenom . ' ' . $reserv->users->nom,
                'start' => $reserv->date_reserve . ' '. $reserv->time_reserve,
                'end' =>  $reserv->date_reserve . ' '. $reserv->time_reserve_end,
                'color' => $color,
                'url' =>   'reservation_data_salle/id='. $reserv->id, 
                
            ];
        }
    
        return response()->json($reservData);

    }

    // ------------------------------------separate functions-----------------------------------------------------

    public function get_data_reserv_user_salle($id){
        $resrvation = Reservationsal::find($id);
        $data = [
            'name' => $resrvation->users->prenom . ' ' . $resrvation->users->nom,
            'filiere' => $resrvation->users->filiere,
            'anne' => $resrvation->users->anne,
            'telephon' => $resrvation->users->telephon,
            'salle' => $resrvation->salles->nom
        ];

        return response()->json($data);
    }

    // ------------------------------------separate functions-----------------------------------------------------

    public function demandes_reserve(Request $request){
  
        $output = '';

        $demandes = Reservationsal::where('valide','=',-1)->orderBy('date_reserve')->paginate(15);

        foreach($demandes as $data){
            $output.='<tr>';
            $output.='<td>'.$data->users->prenom.' '.$data->users->nom.'('.$data->salles->nom.' | '.$data->date_reserve.')'.'</td>'.
                     '<td><button type="button" class="btn btn-sm btn-primary yop" value='.$data->id.'>Oui</button'.
                     '<td><button type="button" class="btn btn-sm btn-danger nop" value='.$data->id.'>Non</button'; 
            $output.='</tr>';        
        }

        return response()->json(['data'=>$output,'reservIds'=>$demandes->pluck('id')]);
    }

    // ------------------------------------separate functions-----------------------------------------------------

    public function demandes_reserve_after(Request $request){
        $output = '';

        $demande = Reservationsal::where('id','=',$request->resId)->first();

        if(!strcmp($request->mode,"y")){
            $demande->valide = 1;
            $demande->save();
            return response()->json(['msg'=>"allRight"]);

        }else{
            $demande->valide = 0;
            $demande->save();
            return response()->json(['msg'=>"allRight"]);
        }

    }
}
