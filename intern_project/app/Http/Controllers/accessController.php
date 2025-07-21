<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class accessController extends Controller
{
    public function showAccessPage()
    {
        return view('access'); 
    }
}
