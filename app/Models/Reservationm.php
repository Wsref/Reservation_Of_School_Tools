<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservationm extends Model
{
    use HasFactory;
    
    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function materiels(){
        return $this->belongsTo(Materiel::class,'materiel_id');
    }
}
