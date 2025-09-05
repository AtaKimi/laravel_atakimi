<?php

namespace App\Http\Controllers\Admin;

use App\Models\Patient;
use App\Models\Hospital;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{
    public function index()
    {
        $hospitals = Hospital::get();
        $patients = Patient::filterByHospital()->paginate(20);
        return view('admin.patients.index', compact('patients', 'hospitals'));
    }

    public function show(Patient $patient)
    {
        return view('admin.patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        $hospitals = Hospital::get();
        return view('admin.patients.edit', compact('patient', 'hospitals'));
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'hospital_id' => 'required|exists:hospitals,id',
        ]);

        $patient->update($request->all());

        return redirect()->route('admin.patients.index')->with('success', 'Patient record updated successfully.');
    }

    public function create()
    {
        $hospitals = Hospital::get();
        return view('admin.patients.create', compact('hospitals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:patients,email',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'hospital_id' => 'required|exists:hospitals,id',
        ]);

        Patient::create($request->all());

        return redirect()->route('admin.patients.index')->with('success', 'Patient record created successfully.');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return response()->json(['message' => 'Patient record deleted successfully.'], 200);
    }
}
