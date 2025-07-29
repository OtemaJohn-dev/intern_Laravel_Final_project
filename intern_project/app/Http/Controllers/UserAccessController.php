<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserAccessController extends Controller
{
    // Show login page
    public function index()
    {
        return view('useraccess');
    }

    // Handle login submission
    public function login(Request $request)
    {
        $request->validate([
            'user_number' => 'required|string',
            'password' => 'required|string',
            'role' => 'required|string|in:doctor,patient',
        ]);

        if ($request->role === 'doctor') {
            $doctor = Doctor::where('user_number', $request->user_number)->first();

            if ($doctor && Hash::check($request->password, $doctor->user_password)) {
                // Save doctor info in session
                Session::put('user_id', $doctor->id);
                Session::put('user_role', 'doctor');

                return redirect()->route('doctor.control.page')
                                 ->with('success', 'Welcome Doctor!');
            } 

            return back()->with('error', 'Invalid credentials for Doctor.');
        }

        if ($request->role === 'patient') {
            $patient = Patient::where('user_number', $request->user_number)->first();

            if ($patient && Hash::check($request->password, $patient->user_password)) {
                // Save patient info in session
                Session::put('user_id', $patient->id);
                Session::put('user_role', 'patient');

                return redirect()->route('patient.control.page')
                                 ->with('success', 'Welcome Patient!');
            } 

            return back()->with('error', 'Invalid credentials for Patient.');
        }

        return back()->with('error', 'Invalid role selected.');
    }

    // Handle logout
    public function logout()
    {
        Session::flush();
        return redirect()->route('useraccess')->with('success', 'You have logged out successfully.');
    }
}
