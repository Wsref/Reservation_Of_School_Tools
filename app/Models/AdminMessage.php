<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminMessage extends Model
{
    use HasFactory;
    public function admins(){
        return $this->belongsTo(Admin::class,'admin_id');
    }
    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
}
