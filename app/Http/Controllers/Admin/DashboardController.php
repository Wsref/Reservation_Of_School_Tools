<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Materiel;
use App\Models\Salle;
use App\Models\Terain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard.dashboard');
    }

    public function chartGlobal(Request $request){
        $data = [];
        
        $data[0] = ($this)->sumReservat(1);
        $data[1] = ($this)->sumReservat(2);
        $data[2] = ($this)->sumReservat(3);
        $data[3] = ($this)->sumReservat(4);
        $data[4] = ($this)->sumReservat(5);
        $data[5] = ($this)->sumReservat(6);
        $data[6] = ($this)->sumReservat(7);
        $data[7] = ($this)->sumReservat(8);
        $data[8] = ($this)->sumReservat(9);
        $data[9] = ($this)->sumReservat(10);
        $data[10] = ($this)->sumReservat(11);
        $data[11] = ($this)->sumReservat(12);

        return response()->json(['data'=>$data]);
    }

    public function chartTerain(Request $request){
        $data = [];
        $data[0] = ($this)->sumReservSepare(1,"reservationts");
        $data[1] = ($this)->sumReservSepare(2,"reservationts");
        $data[2] = ($this)->sumReservSepare(3,"reservationts");
        $data[3] = ($this)->sumReservSepare(4,"reservationts");
        $data[4] = ($this)->sumReservSepare(5,"reservationts");
        $data[5] = ($this)->sumReservSepare(6,"reservationts");
        $data[6] = ($this)->sumReservSepare(7,"reservationts");
        $data[7] = ($this)->sumReservSepare(8,"reservationts");
        $data[8] = ($this)->sumReservSepare(9,"reservationts");
        $data[9] = ($this)->sumReservSepare(10,"reservationts");
        $data[10] = ($this)->sumReservSepare(11,"reservationts");
        $data[11] = ($this)->sumReservSepare(12,"reservationts");     

        return response()->json(['data'=>$data]);
    }

    public function chartSalle(Request $request){
        $data = [];
        $data[0] = ($this)->sumReservSepare(1,"reservationsals");
        $data[1] = ($this)->sumReservSepare(2,"reservationsals");
        $data[2] = ($this)->sumReservSepare(3,"reservationsals");
        $data[3] = ($this)->sumReservSepare(4,"reservationsals");
        $data[4] = ($this)->sumReservSepare(5,"reservationsals");
        $data[5] = ($this)->sumReservSepare(6,"reservationsals");
        $data[6] = ($this)->sumReservSepare(7,"reservationsals");
        $data[7] = ($this)->sumReservSepare(8,"reservationsals");
        $data[8] = ($this)->sumReservSepare(9,"reservationsals");
        $data[9] = ($this)->sumReservSepare(10,"reservationsals");
        $data[10] = ($this)->sumReservSepare(11,"reservationsals");
        $data[11] = ($this)->sumReservSepare(12,"reservationsals");     

        return response()->json(['data'=>$data]);
    }

    public function chartMateriel(Request $request){
        $data = [];
        $data[0] = ($this)->sumReservSepare(1,"reservationms");
        $data[1] = ($this)->sumReservSepare(2,"reservationms");
        $data[2] = ($this)->sumReservSepare(3,"reservationms");
        $data[3] = ($this)->sumReservSepare(4,"reservationms");
        $data[4] = ($this)->sumReservSepare(5,"reservationms");
        $data[5] = ($this)->sumReservSepare(6,"reservationms");
        $data[6] = ($this)->sumReservSepare(7,"reservationms");
        $data[7] = ($this)->sumReservSepare(8,"reservationms");
        $data[8] = ($this)->sumReservSepare(9,"reservationms");
        $data[9] = ($this)->sumReservSepare(10,"reservationms");
        $data[10] = ($this)->sumReservSepare(11,"reservationms");
        $data[11] = ($this)->sumReservSepare(12,"reservationms");     

        return response()->json(['data'=>$data]);
    }

    protected function sumReservSepare($mois,$table){
        $curYear = date('Y');
        $Reserv = DB::select("
        SELECT id 
        FROM $table 
        WHERE EXTRACT(YEAR FROM date_reserve) = $curYear 
        AND EXTRACT(MONTH FROM date_reserve) = $mois
        ");
        $sum = count($Reserv);
        return $sum;
    }

    protected function sumReservat($mois){
        $curYear = date('Y');
        $ResM = DB::select("
            SELECT id 
            FROM reservationms 
            WHERE EXTRACT(YEAR FROM date_reserve) = $curYear 
            AND EXTRACT(MONTH FROM date_reserve) = $mois
        ");
        $ResSal = DB::select("
        SELECT id 
        FROM reservationsals 
        WHERE EXTRACT(YEAR FROM date_reserve) = $curYear 
        AND EXTRACT(MONTH FROM date_reserve) = $mois
        ");
        $ResT = DB::select("
        SELECT id 
        FROM reservationts 
        WHERE EXTRACT(YEAR FROM date_reserve) = $curYear 
        AND EXTRACT(MONTH FROM date_reserve) = $mois
        ");

        $countM = count($ResM);
        $countT = count($ResT);
        $countS = count($ResSal);
        $sum = $countM + $countS + $countT; 
        return $sum;
        
    }
}
