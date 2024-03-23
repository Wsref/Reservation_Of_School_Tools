<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservationsal extends Model
{
    use HasFactory;
    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function salles(){
        return $this->belongsTo(Salle::class,'salle_id');
    }
}
