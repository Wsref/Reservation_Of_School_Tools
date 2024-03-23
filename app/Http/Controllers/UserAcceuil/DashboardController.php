<?php

namespace App\Http\Controllers\UserAcceuil;
use App\Http\Controllers\Controller;
use App\Models\Evenement;
use Illuminate\Http\Request;

use App\Models\Evenemnt;

class DashboardController extends Controller
{
    public function index(){

        $events = Evenement::orderBy('date_diffus', 'desc')
                   ->orderBy('time_diffus', 'desc')
                   ->paginate(3);

        $nbr = 0;

        return view('user.acceuilFolder.dashboard',compact('events','nbr'));

    }

    public function myoneEvent($id,$nb){
        $events = Evenement::orderBy('date_diffus', 'desc')
        ->orderBy('time_diffus', 'desc')
        ->paginate(4);
        $nbr = $nb;

        return view('user.acceuilFolder.dashboard',compact('events','nbr'));       
    }

    
}
