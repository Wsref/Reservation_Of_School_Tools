<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_messages extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'request_id';
    protected $fillable = [
        // Other fillable columns...
        'request_status',
    ];
}
