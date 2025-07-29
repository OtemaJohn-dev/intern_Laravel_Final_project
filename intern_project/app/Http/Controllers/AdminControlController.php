<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Drug;
use Illuminate\Support\Facades\Hash;

class AdminControlController extends Controller
{

    public function index()
    {
        $doctors = Doctor::all();
        $drugs = Drug::all();
        return view ('adminControlPage', compact('doctors', 'drugs'));
    }

 public function storeDoctor(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'user_role' => 'required|string',
        'user_number' => 'required|string|unique:doctors',
        'user_password' => 'required|string|min:6',
    ]);

    Doctor::create([
        'name' => $request->name,
        'user_role' => $request->user_role,
        'user_number' => $request->user_number,
        'user_password' => Hash::make($request->user_password),
    ]);

    return redirect()->back()->with('success', 'Doctor added successfully!');
}

public function editDoctor($id)
{
    $doctor = Doctor::findOrFail($id);
    return response()->json($doctor);
}

public function updateDoctor(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'user_role' => 'required|string',
        'user_number' => 'required|string|unique:doctors,user_number,' . $id,
        'user_password' => 'nullable|string|min:6',
    ]);

    $doctor = Doctor::findOrFail($id);
    $doctor->name = $request->name;
    $doctor->user_role = $request->user_role;
    $doctor->user_number = $request->user_number;

    if ($request->filled('user_password')) {
        $doctor->user_password = Hash::make($request->user_password);
    }

    $doctor->save();

    return redirect()->back()->with('success', 'Doctor updated successfully!');
}



    public function deleteDoctor($id)
    {
        Doctor::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Doctor deleted successfully!');
    }

    public function storeDrug(Request $request)
    {
        $request->validate([
            'drug_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'manufacture_date' => 'required|date',
            'expiry_date' => 'required|date|after:manufacture_date',
            'price' => 'required|numeric|min:0',
        ]);

        Drug::create($request->all());

        return redirect()->back()->with('success', 'Drug added successfully!');
    }

    public function editDrug($id)
    {
        $drug = Drug::findOrFail($id);
        return response()->json($drug);
    }

    public function updateDrug(Request $request, $id)
    {
        $request->validate([
            'drug_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'manufacture_date' => 'required|date',
            'expiry_date' => 'required|date|after:manufacture_date',
            'price' => 'required|numeric|min:0',
        ]);

        $drug = Drug::findOrFail($id);
        $drug->update($request->all());

        return redirect()->back()->with('success', 'Drug updated successfully!');
    }

    public function deleteDrug($id)
    {
        Drug::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Drug deleted successfully!');
    }
}