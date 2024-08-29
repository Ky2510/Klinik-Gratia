<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::all();
        return response()->json($doctors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Set validation
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
        ]);

        // If validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create doctor
        $doctor = Doctor::create([
            'name' => $request->name,
            'specialization' => $request->specialization
        ]);

        // Return response JSON doctor is created
        return response()->json($doctor, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $id)
    {
        return response()->json($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $id)
    {
        // Set validation
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
        ]);

        // If validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Update doctor
        $id->update($request->all());

        // Return response JSON doctor is updated
        return response()->json($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $id)
    {
        $id->delete();
        return response()->json(['message' => 'Doctor deleted successfully']);
    }

    public function datatables()
    {
        $doctors = Doctor::query();

        return DataTables::of($doctors)
        ->make(true);
    }

    public function dataTableWeb()
    {
        if (request()->ajax()) {
            $doctors = Doctor::query();
            return DataTables::of($doctors)

                ->make();
        }
        return view('doctor');
    }
}
