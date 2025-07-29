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
     * Display the Patient Control Page with prescriptions.
     */
    public function displayindex()
    {
        $user = Auth::user();

        // Fetch prescriptions by patient name
        $prescriptions = Prescription::where('pat_name', $user->name)->get();

        return view('patControlPage', compact('prescriptions'));
    }

    /**
     * Handle appointment request submission.
     */
    public function requestAppointment(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to request an appointment.');
        }

        $user = Auth::user();

        $request->validate([
            'appointment_date' => 'required|date|after_or_equal:today',
        ]);

        Appointment::create([
            'patient_name'     => $user->name,
            'appointment_date' => $request->appointment_date,
            'status'           => 'pending',
        ]);

        return redirect()->back()->with('success', 'Appointment requested successfully!');
    }

    /**
     * Handle patient feedback submission.
     */
    public function sendFeedback(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to send feedback.');
        }

        $user = Auth::user();

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        Feedback::create([
            'patient_name' => $user->name,
            'message'      => $request->message,
        ]);

        return redirect()->back()->with('success', 'Feedback sent successfully!');
    }
}
