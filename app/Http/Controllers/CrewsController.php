<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrewsController extends Controller
{
    
    public function show201($applicantNo) {
        if(session('employeeid')) {

            
        } else return redirect('/')->with('error', 'You must login first!!');
    }
    
}
