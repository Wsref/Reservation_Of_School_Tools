<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservationm extends Model
{
    use HasFactory;
    
    // public function users(){
    //     return $this->belongsTo(User::class,'user_id');
    // }

    protected $fillable = ['user_id', 'materiel_id', 'quantite', 'date_reserve', 'valide'];

    public function user()
    {
        return $this->belongsTo(individuals::class, 'user_id');
    }

    public function materiels(){
        return $this->belongsTo(materiels::class,'materiel_id');
    }
}
