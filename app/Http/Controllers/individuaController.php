<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\individuals;

class individuaController extends Controller
{
    //
    public function getindividualData()
    {
        $data = individuals::all();
        return response()->json($data);
    }
}
