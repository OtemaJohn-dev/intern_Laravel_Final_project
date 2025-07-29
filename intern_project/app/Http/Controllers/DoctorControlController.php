<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\Drug;
use App\Models\Appointment;
use App\Models\Feedback;
use Illuminate\Support\Facades\Hash;

class DoctorControlController extends Controller
{
    
    public function displayindex()
    {
        $patients = Patient::all();
        $prescriptions = Prescription::all();
        $drugs = Drug::all();
        $appointments = Appointment::all();
        $feedbacks = Feedback::all();

        return view('docControlPage', compact('patients', 'prescriptions', 'drugs', 'appointments', 'feedbacks'));
    }
    public function storePatient(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'user_number' => 'required|string|unique:patients',
            'user_password' => 'required|string|min:6',
        ]);

        Patient::create([
            'name' => $request->name,
            'age' => $request->age,
            'user_number' => $request->user_number,
            'user_password' => Hash::make($request->user_password),
        ]);

        return redirect()->back()->with('success', 'Patient added successfully!');
    }

    public function updatePatient(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'user_number' => 'required|string',
            'user_password' => 'nullable|string|min:6',
        ]);

        $patient = Patient::findOrFail($id);
        $patient->name = $request->name;
        $patient->age = $request->age;
        $patient->user_number = $request->user_number;

        if ($request->filled('user_password')) {
            $patient->user_password = Hash::make($request->user_password);
        }

        $patient->save();
        return redirect()->back()->with('success', 'Patient updated successfully!');
    }

    public function deletePatient($id)
    {
        Patient::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Patient deleted successfully!');
    }

 public function storePrescription(Request $request)
    {
        $request->validate([
            'pat_name' => 'required|string|max:255',
            'user_number' => 'required|string|max:255',
            'signs_and_symptoms' => 'required|string',
            'medicine' => 'required|string',
        ]);

        Prescription::create([
            'pat_name' => $request->pat_name,
            'user_number' => $request->user_number,
            'signs_and_symptoms' => $request->signs_and_symptoms,
            'medicine' => $request->medicine,
        ]);

        return redirect()->back()->with('success', 'Prescription added successfully!');
    }

    public function updatePrescription(Request $request, $id)
    {
        $request->validate([
            'pat_name' => 'required|string|max:255',
            'user_number' => 'required|string|max:255',
            'signs_and_symptoms' => 'required|string',
            'medicine' => 'required|string',
        ]);

        $prescription = Prescription::findOrFail($id);
        $prescription->update([
            'pat_name' => $request->pat_name,
            'user_number' => $request->user_number,
            'signs_and_symptoms' => $request->signs_and_symptoms,
            'medicine' => $request->medicine,
        ]);

        return redirect()->back()->with('success', 'Prescription updated successfully!');
    }

    public function approveAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'approved';
        $appointment->save();
        return redirect()->back()->with('success', 'Appointment approved!');
    }

    public function postponeAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'postponed';
        $appointment->save();
        return redirect()->back()->with('success', 'Appointment postponed!');
    }

    public function sendAdvice(Request $request, $id)
    {
        $request->validate([
            'doctor_advice' => 'required|string',
        ]);

        $feedback = Feedback::findOrFail($id);
        $feedback->doctor_advice = $request->doctor_advice;
        $feedback->save();

        return redirect()->back()->with('success', 'Advice sent successfully!');
    }
}