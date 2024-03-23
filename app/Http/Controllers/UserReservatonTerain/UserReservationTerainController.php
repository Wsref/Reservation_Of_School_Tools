<?php

namespace App\Http\Controllers\UserReservatonTerain;
use App\Http\Controllers\Controller;
use App\Models\Reservationt;
use App\Models\Terain;
use Illuminate\Http\Request;

class UserReservationTerainController extends Controller
{
    public function reserve(){
        $mes_terain = Terain::all();
        $progress = 33;
        return view('user.reservationTerainFolder.resrveTerain',compact('mes_terain','progress'));
    }

    // ----------------------------------------------------------------

    public function next_to_terain_reserve($id){
        $progress = 66;
        return view('user.reservationTerainFolder.resrveTerainNext',compact('id','progress'));
    }

    // ----------------------------------------------------------------

    public function jereserve(Request $request,$id,$id2){
        $progress = 100;
        $check_reserv_of_user = Reservationt::where('user_id','=',$id2)
                               ->where('date_reserve','Like',$request->input('dateR'))
                               ->get();

        if(!count($check_reserv_of_user)){
            $reservation = new Reservationt();
            $reservation->user_id = $id2;
            $reservation->terain_id = $id;
            $reservation->date_reserve = $request->input('dateR');
            $reservation->time_reserve = $request->input('heure'); 
            $reservation->save();
            
            $statusV = "Votre réservation du terrain de football de l'école dans une heure a été validée avec succès ! 
            Préparez-vous à vivre une expérience passionnante sur le terrain. 
            Assurez-vous d'être prêt à temps et profitez au maximum de votre session de jeu. 
            En cas de questions ou de besoins supplémentaires, n'hésitez pas à nous contacter. Bon match !";

            return redirect('/reservationTerain_Status')->with(compact('statusV','progress'));
        }else{
            $statusNV = "Nous regrettons de vous informer que votre réservation du terrain de football 
            de l'école n'a pas pu être confirmée pour le jour que vous avez choisi. 
            Il semble qu'une réservation a déjà été effectuée pour ce jour-là. 
            Veuillez sélectionner une autre date pour votre réservation. 
            Si vous avez des questions ou avez besoin d'assistance pour trouver 
            un créneau disponible, n'hésitez pas à nous contacter. 
            Nous sommes là pour vous aider à organiser votre prochaine session de jeu. Merci pour votre compréhension.";

            return redirect('/reservationTerain_Status')->with(compact('statusNV','progress'));
        }



    }

    // ----------------------------------------------------------------

    public function reservationStatus(){

        return view('user.reservationTerainFolder.reservationsTerainStatus');

    }

    // ----------------------------------------------------------------

    public function check_available_hours(Request $resquest){

        $output='<option value="" disabled selected>choisir...</option>';
        $heursOfficiel = ['08:00:00','09:00:00','10:00:00','11:00:00','12:00:00',
                           '13:00:00','14:00:00','15:00:00','16:00:00','17:00:00'];
        $heursReserved = [];
        $reservationOfDateChosed = Reservationt::where('date_reserve','Like',$resquest->dateResrv)->get();
    
        foreach($reservationOfDateChosed as $res){
            $heursReserved[] = $res->time_reserve; 
        }
        
        $resultHeur = array_diff($heursOfficiel,$heursReserved);
    
        foreach($resultHeur as $res){
            $output.='
            <option value='.$res.'>'.$res.'</option>
            ';
        }
    
    
        return response()->json([
            'data' => $output,
        ]);
    
    
    }

}
