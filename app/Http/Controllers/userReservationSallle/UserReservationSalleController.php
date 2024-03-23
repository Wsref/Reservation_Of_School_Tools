<?php

namespace App\Http\Controllers\userReservationSallle;

use App\Http\Controllers\Controller;
use App\Models\Reservationsal;
use App\Models\Salle;
use Illuminate\Http\Request;

class UserReservationSalleController extends Controller
{
    public function reserve(){
        $mes_salles = Salle::all();
        $progress = 33;
        return view('user.reservationSalleFolder.reserveSalle',compact('mes_salles','progress'));

    }

    public function next_to_salle_reserve($id){
        $progress = 66;
        return view('user.reservationSalleFolder.reserveSalleNext',compact('progress','id'));
    }

    public function retrieve_salle_heureDe_reserv(Request $request){

        

        $heursOfficiel = ['08:00:00','09:00:00','10:00:00','11:00:00','12:00:00',
                           '13:00:00','14:00:00','15:00:00','16:00:00','17:00:00'];
        
        $sall_reserv = Reservationsal::where('date_reserve','=',$request->dateR)
                                       ->where('salle_id','=',$request->salle_id)
                                       ->get();

        if(count($sall_reserv)<=0){
            $output1 = '<option value="" disabled selected>choisir...</option>';
            foreach($heursOfficiel as $heure){
                $output1.='<option value='.$heure.'>'.$heure.'</option>';
            }
            return response()->json(['heureDe'=>$output1,'heureDeTable'=>$heursOfficiel,'isNewDateR'=>1]);
        }else{
            $output2 = '<option value="" disabled selected>choisir...</option>';
            
            $heureReserved = [];
            foreach($sall_reserv as $data){
                $heureDe_num = (int) explode(':',$data->time_reserve)[0];
                $heureA_num = (int) explode(':',$data->time_reserve_end)[0];
                while($heureDe_num < $heureA_num){
                    $heureDe_as_string = sprintf("%02d:00:00",$heureDe_num);
                    $heureReserved[] = $heureDe_as_string;
                    $heureDe_num++;
                }
            }

            $heureDisponible = array_diff($heursOfficiel,$heureReserved);
            foreach($heureDisponible as $heure){
                $output2.='<option value='.$heure.'>'.$heure.'</option>';
            }

            return response()->json(['heureDe'=>$output2,'heureDeTable'=>$heureDisponible,'isNewDateR'=>0]);

        }
    }


    public function retrieve_salle_heureA_reserv(Request $request){

        $myreq_heureDe = (int) explode(':', $request->heureDe)[0];
        $heureADisponible = [];
        foreach($request->heureDeTable as $heure){
          $temp_h = (int) explode(':', $heure)[0];
          if($myreq_heureDe < $temp_h){
            $heureADisponible[] = $heure;
          }
        }

        if($request->isNewDateR){

          $output1='<option value="" disabled selected>choisir...</option>';
          $latest_hourDe = $heureADisponible[count($heureADisponible)-1];
          $latest_hourDe_toNum = (int) explode(':',$latest_hourDe)[0];
          $latest_hourDe_toNum++;
          $latest_hourDe = sprintf("%02d",$latest_hourDe_toNum);
          $heureAtotal[] = $latest_hourDe;
          $temp_tableA = $heureADisponible;
          $heureAtotal = array_merge($temp_tableA,$heureAtotal);

          foreach($heureAtotal as $heure){
            $output1.='<option value='.$heure.'>'.$heure.'</option>';
          }

          return response()->json(['heureA'=>$output1]);

        }else{

          $output2='<option value="" disabled selected>choisir...</option>';
          $flag_latest_hour = 1;
          $heureAFree = [];
          $my_time = (int) explode(':',$request->heureDe)[0];
          foreach($heureADisponible as $heure){
            $temp_heure = (int) explode(':',$heure)[0];
            if(($temp_heure - $my_time)<=1 && ($temp_heure - $my_time)>0 ){
              $my_time++;
              $my_time_as_string = sprintf("%02d:00:00",$my_time);
              $heureAFree[] = $my_time_as_string;
            }else{
              $my_time++;
              $my_time_as_string_2 = sprintf("%02d:00:00",$my_time);
              $heureAFree[] = $my_time_as_string_2;
              $flag_latest_hour = 0;
              break;
            }

          }
          if($flag_latest_hour){
            $my_time++;
            $mon_heure_by_flag = sprintf("%02d:00:00",$my_time);
            $heureAFree[] = $mon_heure_by_flag;

          }
          if(count($heureAFree)<=0){
            $monheure = (int) explode(':',$request->heureDe)[0];
            $monheure++;
            $monheure_as_string = sprintf("%02d:00:00",$monheure);
            $heureAFree[] = $monheure_as_string;

          }
          foreach($heureAFree as $heure){
            $output2.='<option value='.$heure.'>'.$heure.'</option>';
          }
          return response()->json(['heureA'=>$output2]);

        }
    }


    public function salle_date_reserve(Request $request,$id,$id2){
        $heureDe = $request->input('heureDe');
        $heureA = $request->input('heureA');
        $dateR = $request->input('dateR');
        $heureDe_toNum = (int) explode(':',$heureDe)[0];
        $heureA_toNum = (int) explode(':',$heureA)[0];
        $progress = 100;

        if($heureA_toNum<$heureDe_toNum){
            $technicalErrors = "Nous sommes désolés, mais une erreur technique est survenue lors de votre tentative de réservation. 
            Veuillez réessayer une prochaine fois. Si le problème persiste, n'hésitez pas à nous contacter pour obtenir de l'aide. 
            Merci pour votre compréhension.";

            return redirect('/reservationSalle_Status')->with(compact('technicalErrors','progress'));
        }

        $check_resrvationSall_of_user_thisDate = Reservationsal::where('user_id','=',$id2)
                                                                 ->where('date_reserve','=',$dateR)
                                                                 ->get();
        if(count($check_resrvationSall_of_user_thisDate)>0){
            $resrveSalle = new Reservationsal();
            $resrveSalle->user_id = $id2;
            $resrveSalle->salle_id = $id;
            $resrveSalle->date_reserve = $dateR;
            $resrveSalle->time_reserve = $heureDe;
            $resrveSalle->time_reserve_end = $heureA;
            $resrveSalle->save();

            $statusW = "Votre réservation de salle a été reçue avec succès. L'administrateur examinera votre demande et pourrait 
            vous contacter pour obtenir des informations supplémentaires. Veuillez noter qu'une réservation a déjà été effectuée 
            pour vous à la même date, bien que ce soit dans une salle différente ou à une heure différente. Cela pourrait influencer 
            la décision de l'administrateur. Si vous avez des raisons particulières, vous pouvez le contacter avant qu'il ne prenne 
            sa décision. Merci pour votre compréhension";

            return redirect('/reservationSalle_Status')->with(compact('statusW','progress'));

        }else{
            $resrveSalle = new Reservationsal();
            $resrveSalle->user_id = $id2;
            $resrveSalle->salle_id = $id;
            $resrveSalle->date_reserve = $dateR;
            $resrveSalle->time_reserve = $heureDe;
            $resrveSalle->time_reserve_end = $heureA;
            $resrveSalle->save();

            $statusV = "Votre réservation de salle a été soumise avec succès. 
            L'administrateur examinera votre demande et pourrait vous contacter pour obtenir des informations supplémentaires. 
            Merci pour votre compréhension";

            return redirect('/reservationSalle_Status')->with(compact('statusV','progress'));

        }

    }

    public function reservationStatus(){
        return view('user.reservationSalleFolder.reservationsSalleStatus');
    }
}
