<?php

namespace App\Http\Controllers\UserHelp;

use App\Http\Controllers\Controller;
use App\Models\Myfaq;
use Illuminate\Http\Request;

class UserfaqsController extends Controller
{
    public function faqs(){
        $faqData = Myfaq::all();
        return view('user.helpFolder.faqs',compact('faqData'));
    }
}
