<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::with('user', 'doctor', 'treatment')->get();
        return response()->json($appointments);
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
            'user_id'          => 'required|uuid|exists:users,uuid',
            'doctor_id'        => 'required|uuid|exists:doctors,id',
            'treatment_id'     => 'required|uuid|exists:treatments,id',
            'appointment_date' => 'required|date_format:Y-m-d',
        ]);
    
        // If validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        // Create appointment
        $appointment = Appointment::create([
            'user_id' => $request->user_id,
            'doctor_id' => $request->doctor_id,
            'treatment_id' => $request->treatment_id,
            'appointment_date' => $request->appointment_date
        ]);
    
        // Return response JSON appointment is created
        return response()->json($appointment, 201);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $id)
    {
        $id->with('user', 'doctor', 'treatment')->get();
        return response()->json($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $id)
    {
        // Set validation
        $validator = Validator::make($request->all(), [
            'user_id'          => 'required|uuid|exists:users,id',
            'doctor_id'        => 'required|uuid|exists:doctors,id',
            'treatment_id'     => 'required|uuid|exists:treatments,id',
            'appointment_date' => 'required|date_format:Y-m-d',
        ]);

        // If validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Update appointment
        $id->update($request->all());

        // Return response JSON appointment is updated
        return response()->json($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $id)
    {
        $id->delete();
        return response()->json(['message' => 'Appointment deleted successfully']);
    }

    public function datatables()
    {
        $appointment = Appointment::query();
        return DataTables::of($appointment)
        ->make(true);
    }

    public function datatableWeb()
    {
        if (request()->ajax()) {
            $appointments = Appointment::with('user', 'doctor', 'treatment')->latest();
            return DataTables::of($appointments)
                ->addColumn('user_name', function ($appointment) {
                    return $appointment->user ? $appointment->user->name : 'N/A';
                })
                ->addColumn('doctor_name', function ($appointment) {
                    return $appointment->doctor ? $appointment->doctor->name : 'N/A';
                })
                ->addColumn('treatment_name', function ($appointment) {
                    return $appointment->treatment ? $appointment->treatment->name : 'N/A';
                })
                ->make(true);
        }
        return view('appointment');
    }
}
