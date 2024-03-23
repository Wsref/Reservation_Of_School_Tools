<?php

namespace App\Http\Controllers\UserReservationMateriel;

use App\Http\Controllers\Controller;
use App\Models\DynamiqueQuantite;
use App\Models\Materiel;
use App\Models\Reservationm;
use Illuminate\Http\Request;

class UserReservationMaterielNextController extends Controller
{
    public function check_available_hours_Materl(Request $request){
        $output='<option value="" disabled selected>choisir...</option>';

        $heursOfficiel = ['08:00:00','09:00:00','10:00:00','11:00:00','12:00:00',
                                '13:00:00','14:00:00','15:00:00','16:00:00'];
        $data_from_dynamique_quantite = DynamiqueQuantite::where('materiel_id','=',$request->materielID)
                                                           ->where('date_reserve','=',$request->dateResrv)
                                                           ->get();

        if(count($data_from_dynamique_quantite)<=0){

            $my_materiel = Materiel::where('id','=',$request->materielID)->first();
            $my_materiel_quantite = $my_materiel->quantite;
            foreach($heursOfficiel as $heure){
              $output.='
              <option value='.$heure.'>'.$heure.'</option>';
            }

            return response()->json(
              ['heureDe'=>$output,'myQuantite'=>$my_materiel_quantite,
              'heureDiponible'=>$heursOfficiel,'isNewDateR'=>1]);

        }else{

            $heureReserved = [];
            $max_dyna_quantite = 0;
            foreach($data_from_dynamique_quantite as $dyn_data){
              if($dyn_data->quantite<=0){
                $heureReserved[]=$dyn_data->time_reserve;
              }else{
                if($dyn_data->quantite>$max_dyna_quantite){ $max_dyna_quantite = $dyn_data->quantite; }
              }
            }
            $heureDisponible = array_diff($heursOfficiel,$heureReserved);
            if(count($heureDisponible)<=0){

                return response()->json(
                  ['heureDe'=>$output,'myQuantite'=>$max_dyna_quantite,
                   'heureDiponible'=>$heureDisponible,'isNewDateR'=>0]);

            }elseif(count($heureDisponible)>=count($data_from_dynamique_quantite)){

                foreach($heureDisponible as $heure){
                  $output.='<option value='.$heure.'>'.$heure.'</option>';
                }
                return response()->json(
                  ['heureDe'=>$output,'myQuantite'=>$max_dyna_quantite,
                   'heureDiponible'=>$heureDisponible,'isNewDateR'=>0]);

            }else{

                $mater_my = Materiel::where('id','=',$request->materielID)->first();
                foreach($heureDisponible as $heure){
                  $output.='<option value='.$heure.'>'.$heure.'</option>';
                }
                return response()->json(
                  ['heureDe'=>$output,'myQuantite'=>$mater_my->quantite,
                   'heureDiponible'=>$heureDisponible,'isNewDateR'=>0]);
            }

        }

    }

    // --------------------------------------------------------------------------------------

    public function retrieve_available_hoursA_Materl(Request $request){
        if (!isset($request->heureDe) || !isset($request->heureDeTable) || !isset($request->materIld) || !isset($request->isNewDateR)) {
          return response()->json(['error' => 'qq data pas valide']);
        }
        
        // khsni ndir wahd table ikono fih les heure officiel 
        // mn ba3d nrdo ikon fih ghi les heure > mn heure likhtar
        // mn ba3d ntistih m3a table likayn flkhar dyal heurefree 
        // lakan count dyalhom bhal bhal hada ya3ni ana max quantite 
        // khsni nakhdo intila9an mndok les heure limsjlin f table dynamique_quantite
        // hitax max fhad l7ala maghadix nakhdoh mn table materiel

        $myreq_heureDe = (int) explode(':', $request->heureDe)[0];
        $materiel_selected = Materiel::where('id','=',$request->materIld)->first();


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

          return response()->json(['heureA'=>$output1,'myQuant'=>$materiel_selected->quantite]);

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
          return response()->json(['heureA'=>$output2,'myQuant'=>$materiel_selected->quantite]);

        }
    }

    // -----------------------------------------------------------------------------------------------

    public function retrieve_availabel_quantite_in_reserved_hours(Request $request){

      // if(!isset($request->heureDe) || !isset($request->heureA) || !isset($request->dateR)
      //  || !isset($request->materiel_id) || !isset($request->isNewDate)){
      //   return response()->json(['dataError'=>1]);
      //  }
    
       $toNum_heureDe = (int) explode(':',$request->heureDe)[0];
       $toNum_heureA = (int) explode(':',$request->heureA)[0];
    
       if( ($toNum_heureA - $toNum_heureDe) <= 0 ){
        return response()->json(['dataError'=>1]);
       }
    
       $my_materiel = Materiel::where('id','=',$request->materiel_id)->first(); 
       if($request->isNewDate){
        
        return response()->json(['quantite'=> $my_materiel->quantite]);

       }else{
    
        $tempHeureDe = $toNum_heureDe;
        $heure_chosed = [];
        while($tempHeureDe < $toNum_heureA){
          $tempHeureDe_as_string = sprintf("%02d:00:00",$tempHeureDe);
          $heure_chosed[] = $tempHeureDe_as_string;
          $tempHeureDe++;
        }
        $max_quantite = 0;
        $qauntite_from_dynamique_quan = DynamiqueQuantite::where('materiel_id','=',$request->materiel_id)
                                                           ->where('date_reserve','=',$request->dateR)
                                                           ->where('time_reserve','=',$heure_chosed[0])
                                                           ->first();
        if(empty($qauntite_from_dynamique_quan)){
          $max_quantite = $my_materiel->quantite;
        }else{
          $max_quantite = $qauntite_from_dynamique_quan->quantite;
        }
        for($i=1;$i<count($heure_chosed);$i++){
          $qauntite_from_dynamique_quan = DynamiqueQuantite::where('materiel_id','=',$request->materiel_id)
                                                           ->where('date_reserve','=',$request->dateR)
                                                           ->where('time_reserve','=',$heure_chosed[$i])
                                                           ->first();
          if(empty($qauntite_from_dynamique_quan)) continue;
          if($qauntite_from_dynamique_quan->quantite<$max_quantite) $max_quantite = $qauntite_from_dynamique_quan->quantite;
        }
    
        return response()->json(['quantite'=>$max_quantite]);
    
       }
     
    }


    // ----------------------------------------------------------------------------------------------------------------------
    public function materiel_date_reserev(Request $request,$id,$id2){
      // if(!isset( $request->input('dateR') ) || !isset( $request->input('heureDe') ) || !isset($request->input('heureA')) || !isset($request->input('quantite')) || !isset($request->input('mxQuant'))){
        
      //   return redirect('/problems')->with('status',"Problemes technique,merci d'essayer pas mal des fois ou vous quittez cette session");

      // }

      $dateR = $request->input('dateR');
      $heureDe = $request->input('heureDe');
      $heureA = $request->input('heureA');
      $quantite = $request->input('quantite');
      $maxQuant = $request->input('mxQuant');
      $my_materiel = Materiel::where('id','=',$id)->first();

      if($quantite > $maxQuant){
        $statusNV = "Nous vous informons que votre demande de réservation de matériel n'a pas encore été confirmée. 
        Malheureusement, la quantité demandée dépasse notre stock disponible actuellement. 
        Nous comprenons que cela puisse être décevant et nous nous excusons pour cet inconvénient. 
        Nous travaillons activement pour résoudre ce problème et nous vous tiendrons informé dès que possible. 
        Si vous avez des questions ou des préoccupations, n'hésitez pas à nous contacter. 
        Merci pour votre patience et votre compréhension.";
        $progress = 100;
        return redirect('/reservation_Status')->with(compact('statusNV','progress'));

      }else{
        $categ_mater = $my_materiel->category;
          if(!strcmp($categ_mater,"fétes")){
                //lakan materiel dyal fetes khass maytsjalx f dynamique_quantite 
                //o ikon valide -1 hitax khass laaziz howa li acceptih oghaywli 1 awla refus oghaywli 0

                $reservationMateriel = new Reservationm();
                $reservationMateriel->user_id = $id2;
                $reservationMateriel->materiel_id = $id;
                $reservationMateriel->quantite = $quantite;
                $reservationMateriel->date_reserve = $dateR;
                $reservationMateriel->time_reserve = $heureDe;
                $reservationMateriel->date_reserve_end = $dateR;
                $reservationMateriel->time_reserve_end = $heureA;
                $reservationMateriel->valide = -1;
                $reservationMateriel->save();

                $statusV = "Nous avons bien reçu votre demande de réservation de matériel.
                 Nous sommes en train de la traiter et nous vous tiendrons informé dès que celle-ci sera confirmée. 
                 Nous vous remercions pour votre patience et votre compréhension. 
                 Si vous avez des questions ou des préoccupations, n'hésitez pas à nous contacter.
                 Nous travaillons activement pour vous offrir la meilleure expérience possible";
                $progress = 100;
                return redirect('/reservation_Status')->with(compact('statusV','progress'));

          }else{

                $toNum_heureDe = (int) explode(':',$heureDe)[0];
                $toNum_heureA = (int) explode(':',$heureA)[0];
                $heureTable = [];
                while($toNum_heureDe<$toNum_heureA){
                  $heure_as_string = sprintf("%02d:00:00",$toNum_heureDe);
                  $heureTable[] = $heure_as_string;
                  $toNum_heureDe++;
                }
        
                foreach($heureTable as $heure){
                  $heur_status = DynamiqueQuantite::where('date_reserve','=',$dateR)
                                                    ->where('time_reserve','=',$heure)
                                                    ->where('materiel_id','=',$id)
                                                    ->first();
                  if(empty($heur_status)){
                    $new_DynaQuan_regis = new DynamiqueQuantite();
                    $quanDyn = $my_materiel->quantite - $quantite;
                    $new_DynaQuan_regis->materiel_id = $id;
                    $new_DynaQuan_regis->quantite = $quanDyn;
                    $new_DynaQuan_regis->date_reserve = $dateR;
                    $new_DynaQuan_regis->time_reserve = $heure;
                    $new_DynaQuan_regis->date_reserve_end = $dateR;
                    $heur_num = (int) explode(':',$heure)[0];
                    $heur_num++;
                    $heur_as_string = sprintf("%02d:00:00",$heur_num);
                    $new_DynaQuan_regis->time_reserve_end = $heur_as_string;
                    $new_DynaQuan_regis->save();
        
                  }else{
                    $heur_status->quantite-=$quantite;
                    $heur_status->save();
                  }
        
                }
        
                $reservationMateriel = new Reservationm();
                $reservationMateriel->user_id = $id2;
                $reservationMateriel->materiel_id = $id;
                $reservationMateriel->quantite = $quantite;
                $reservationMateriel->date_reserve = $dateR;
                $reservationMateriel->time_reserve = $heureDe;
                $reservationMateriel->date_reserve_end = $dateR;
                $reservationMateriel->time_reserve_end = $heureA;
                $reservationMateriel->save();
        
                $statusV = "Votre réservation de matériel auprès de notre établissement a été confirmée avec succès. 
                Nous vous remercions pour votre confiance. Le matériel que vous avez sélectionné sera prêt à votre arrivée.
                Si vous avez des besoins spécifiques ou des questions, n'hésitez pas à nous contacter.
                Nous sommes impatients de vous servir et de vous offrir une expérience exceptionnelle !";
                $progress = 100;
                return redirect('/reservation_Status')->with(compact('statusV','progress'));
    
          }


      }


    }


}
