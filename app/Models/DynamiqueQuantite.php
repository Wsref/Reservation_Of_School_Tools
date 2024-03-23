<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamiqueQuantite extends Model
{
    use HasFactory;
    public function materiels(){
        return $this->belongsTo(Materiel::class,'materiel_id');
    }
}
