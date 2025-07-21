<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;

class UserAccessController extends Controller
{
    // Display User Access Page
    public function index()
    {
        return view('useraccess');
    }

    // Handle Login
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
                return redirect()->route('doctor.control.page');
            } else {
                return back()->with('error', 'Invalid credentials for Doctor.');
            }
        }

        if ($request->role === 'patient') {
            $patient = Patient::where('user_number', $request->user_number)->first();

            if ($patient && Hash::check($request->password, $patient->user_password)) {
                return redirect()->route('patient.control.page');
            } else {
                return back()->with('error', 'Invalid credentials for Patient.');
            }
        }

        return back()->with('error', 'Invalid role selected.');
    }
}
