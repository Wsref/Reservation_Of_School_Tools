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
        return view('admin.reservation.reservationt');
    }

    // ------------------------------------separate functions-----------------------------------------------------

    public function get_data_reserv(){
        $reservations = Reservationt::with('users')->get();
        $reservData = [];
    
        foreach ($reservations as $reserv) {
            $reservData[] = [
                'title' => $reserv->users->prenom . ' ' . $reserv->users->nom,
                'start' => $reserv->date_reserve,
                'end' => Carbon::parse($reserv->date_reserve)->addHour(1),
                'color' => $reserv->valide ? 'blue':'red',
                'url' =>   'reservation_data/id='. $reserv->users->id, 
                
            ];
        }
    
        return response()->json($reservData);

    }

    // ------------------------------------separate functions-----------------------------------------------------

    public function get_data_reserv_user($id){
        $user = User::find($id);
        $data = [
            'name' => $user->prenom . ' ' . $user->nom,
            'filiere' => $user->filiere,
            'anne' => $user->anne,
            'telephon' => $user->telephon,

        ];

        return response()->json($data);
    }

}
