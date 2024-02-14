<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin_messages extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        // Other fillable columns...
        'response_status',
    ];
}
