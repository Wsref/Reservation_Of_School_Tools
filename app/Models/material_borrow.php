<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\messages;

class material_borrow extends Model
{
    use HasFactory;
    protected $table = 'material_borrow';
    public $timestamps = false;

    
}
