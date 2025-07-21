<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Prescription;
use App\Models\Appointment;
use App\Models\Feedback;

class PatientControlController extends Controller
{
    /**
     * Display the Patient Control Page
     */
    public function index()
    {
        // Get logged-in user's user_number
        $user_number = Auth::user()->user_number;

        // Fetch the patient's prescriptions
        $prescriptions = Prescription::where('user_number', $user_number)->get();

        return view('patControlPage', compact('prescriptions'));
    }

    /**
     * Request an Appointment
     */
    public function requestAppointment(Request $request)
    {
        $request->validate([
            'appointment_date' => 'required|date',
        ]);

        // Save appointment request
        Appointment::create([
            'patient_name'   => Auth::user()->name,
            'user_number'    => Auth::user()->user_number,
            'appointment_date' => $request->appointment_date,
            'status'         => 'pending',
        ]);

        return redirect()->back()->with('success', 'Appointment requested successfully!');
    }

    /**
     * Send Feedback
     */
    public function sendFeedback(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // Save patient feedback
        Feedback::create([
            'patient_name' => Auth::user()->name,
            'user_number'  => Auth::user()->user_number,
            'message'      => $request->message,
        ]);

        return redirect()->back()->with('success', 'Feedback sent successfully!');
    }
}
