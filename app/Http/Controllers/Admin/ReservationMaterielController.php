<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservationm;
use Illuminate\Http\Request;

class ReservationMaterielController extends Controller
{
    public function index(){
        return view('admin.reservation.reservationm');
    }

    // ------------------------------------separate functions-----------------------------------------------------

    public function get_data_reserv(){
        $reservations = Reservationm::with('users')->get();
        $reservData = [];
    
        foreach ($reservations as $reserv) {
            $reservData[] = [
                'title' => $reserv->users->prenom . ' ' . $reserv->users->nom,
                'start' => $reserv->date_reserve,
                'end' =>  $reserv->date_reserve,
                'color' => $reserv->valide ? 'blue':'red',
                'url' =>   'reservation_data_materiel/id='. $reserv->id, 
                
            ];
        }
    
        return response()->json($reservData);

    }

    // ------------------------------------separate functions-----------------------------------------------------

    public function get_data_reserv_user_materiel($id){
        $resrvation = Reservationm::find($id);
        $data = [
            'name' => $resrvation->users->prenom . ' ' . $resrvation->users->nom,
            'filiere' => $resrvation->users->filiere,
            'anne' => $resrvation->users->anne,
            'telephon' => $resrvation->users->telephon,
            'materiel' => $resrvation->materiels->name,
            'category' => $resrvation->materiels->category,
            'quantite' => $resrvation->quantite,

        ];

        return response()->json($data);
    }

}
