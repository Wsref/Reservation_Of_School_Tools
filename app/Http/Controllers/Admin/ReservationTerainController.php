<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservationt;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationTerainController extends Controller
{
    public function index(){
        $curYear = date("Y");
        $curMonth = date("m");
        $curDay = date("d");
        $curDate = $curYear .'-'. $curMonth .'-'. $curDay;
        $curHour = (int) date("H");

        $reservationPasse = Reservationt::all();
        foreach($reservationPasse as $data){
            $isold = ($this)->isOldDate($curDate,$data->date_reserve,$curHour,$data->time_reserve_end);
            if($isold){
                $data->valide = 0;
                $data->save();
            }
        }
        return view('admin.reservation.reservationt');
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
        $reservations = Reservationt::with('users')->get();
        $reservData = [];
    
        foreach ($reservations as $reserv) {
            if($reserv->valide<0) $color = "orange";
            elseif($reserv->valide==0) $color="red";
            else $color="blue";

            $my_res_time = Carbon::createFromFormat('H:i:s', $reserv->time_reserve);
            $my_res_time->addHour();
            $my_res_time_updated = $my_res_time->format('H:i:s');
            
            $reservData[] = [
                'title' => $reserv->users->prenom . ' ' . $reserv->users->nom,
                'start' => $reserv->date_reserve . ' '. $reserv->time_reserve,
                'end' => $reserv->date_reserve . ' '. $my_res_time_updated,
                'color' => $color,
                'url' =>   'reservation_data/id='. $reserv->id, 
                
            ];
        }
    
        return response()->json($reservData);

    }

    // ------------------------------------separate functions-----------------------------------------------------

    public function get_data_reserv_user($id){
        $reserv = Reservationt::find($id);
        $data = [
            'name' => $reserv->users->prenom . ' ' . $reserv->users->nom,
            'filiere' => $reserv->users->filiere,
            'anne' => $reserv->users->anne,
            'telephon' => $reserv->users->telephon,
            'terain' => $reserv->terains->nom,

        ];

        return response()->json($data);
    }

}
