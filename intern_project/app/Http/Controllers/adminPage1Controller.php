<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class adminPage1Controller extends Controller
{
    public function showLoginPage()
    {
        return view('adminaccess'); 
    }

    public function verifyAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        
        $admin = DB::table('users')
            ->where('email', $request->email)
            ->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            
            return redirect()->route('adminControlPage');
        } else {
            
            return redirect()->back()->with('error', 'Invalid email or password. Please try again.');
        }
    }
}
