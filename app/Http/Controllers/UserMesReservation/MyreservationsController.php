<?php

namespace App\Http\Controllers\UserMesReservation;
use App\Http\Controllers\Controller;
use App\Models\Reservationm;
use App\Models\Reservationsal;
use App\Models\Reservationt;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class MyreservationsController extends Controller
{
    public function myreserve(){
        return view('user.mesreservationFolder.myreservations');
    }

    // -------------------------------------------------------------------------------------------

    public function retrieve_mesreservation(Request $request){
        
        $filterName = $request->filterName;
        if($filterName!==NULL){
            switch($filterName){
                case "Terain" : {
                    $output1 = '<tr class='.'table-active'.'>';
                    $mesresrv = Reservationt::where('user_id','=',$request->userId)
                                             ->where('date_reserve','>=',date('Y-m-d'))
                                             ->orderBy('date_reserve')
                                             ->orderBy('time_reserve')
                                             ->paginate(8);
                                            
                                             
                    foreach($mesresrv as $data){
                        $output1.='<th scope='.'row'.'>'.$filterName.'</th>';
                        $output1.='<td>'.$data->date_reserve.'</td>';
                        $output1.='<td>'.$data->time_reserve.'</td>';

                        $timeNum = (int) explode(':',$data->time_reserve)[0];
                        $timeNum++;
                        $time_to_string = sprintf("%02d:00:00",$timeNum);

                        $output1.='<td>'.$time_to_string.'</td>';
                        $output1.='<td>'.$data->terains->nom.'</td>';
                        $valide = $this->getValidationState($data->valide);
                        $output1.='<td>'.$valide.'</td>';
                        $output1.='</tr>';
                    }
                    return response()->json(['mesreservationTable'=>$output1]);
                }break;
                case "Materiel" : {
                    $output1 = '<tr class='.'table-active'.'>';
                    $mesresrv = Reservationm::where('user_id','=',$request->userId)
                                             ->where('date_reserve','>=',date('Y-m-d'))
                                             ->orderBy('date_reserve')
                                             ->orderBy('time_reserve')
                                             ->paginate(8);
                    foreach($mesresrv as $data){
                        $output1.='<th scope='.'row'.'>'.$filterName.'</th>';
                        $output1.='<td>'.$data->date_reserve.'</td>';
                        $output1.='<td>'.$data->time_reserve.'</td>';                        
                        $output1.='<td>'.$data->time_reserve_end.'</td>';
                        $output1.='<td>'.$data->materiels->name.'</td>';
                        $valide = $this->getValidationState($data->valide);
                        $output1.='<td>'.$valide.'</td>';
                        $output1.='</tr>';
                    }
                    return response()->json(['mesreservationTable'=>$output1]);
                }break;
                case "Salle" : {
                    $output1 = '<tr class='.'table-active'.'>';
                    $mesresrv = Reservationsal::where('user_id','=',$request->userId)
                                             ->where('date_reserve','>=',date('Y-m-d'))
                                             ->orderBy('date_reserve')
                                             ->orderBy('time_reserve')
                                             ->paginate(8);
                    foreach($mesresrv as $data){
                        $output1.='<th scope='.'row'.'>'.$filterName.'</th>';
                        $output1.='<td>'.$data->date_reserve.'</td>';
                        $output1.='<td>'.$data->time_reserve.'</td>';                        
                        $output1.='<td>'.$data->time_reserve_end.'</td>';
                        $output1.='<td>'.$data->salles->nom.'</td>';
                        $valide = $this->getValidationState($data->valide);
                        $output1.='<td>'.$valide.'</td>';
                        $output1.='</tr>';
                    }
                    return response()->json(['mesreservationTable'=>$output1]);
                }break;
            }

            

        }
    }

    public function getValidationState($valdiate){
        switch($valdiate){
            case 1 : {return "Approuvé";}break;
            case 0 : {return "Refusé";}break;
            case -1 : {return "En attent";}break;
        }
    }
}
