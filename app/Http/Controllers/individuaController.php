<?php

namespace App\Http\Controllers;

use App\Models\individuals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Symfony\Component\VarDumper\VarDumper;

class individuaController extends Controller
{
    //
    public function getindividualData()
    {
        $data = individuals::all();
        return response()->json($data);
    }


    public function filterANDreload(Request $request)
    {
                // Start building the query
                $query = DB::table('individuals');

dd($request->all());
        foreach ($request->all() as $propertyName => $propertyarray) {    
            // Check if the value is an array
            dd($propertyarray);
            if (is_array($propertyarray)) {
                // Add a whereIn condition for the array of values
                $query->whereIn($propertyName, $propertyarray);
            }
        }
        
                // Execute the query and retrieve the results
                // $users = $query->get(['id', 'fname', 'pname', 'year', 'branch','email','password'])->toArray();        
                // $users = $query->get(['id', 'fname', 'pname', 'year', 'branch']);

                // $users = $users->map(function ($user) {
                //     return $user->toArray();
                // })->toArray();

                $userscoll = $query->get(['id', 'fname', 'pname', 'year', 'branch','email','password']);
                $users = [];

                foreach ($userscoll as $user) {
                    $userArray = (array) $user; // Convert stdClass object to array
                    $users[] = $userArray;
                }

                // Process and return the results as needed
                // var_dump($users);
                return View::make('components.user', ['users' => $users])->render();
        
    }

    
}
