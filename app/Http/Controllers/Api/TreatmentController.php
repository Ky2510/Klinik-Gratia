<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $treatments = Treatment::all();
        return response()->json($treatments);
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
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // If validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create treatment
        $treatment = Treatment::create($request->all());

        // Return response JSON treatment is created
        return response()->json($treatment, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function show(Treatment $id)
    {
        return response()->json($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Treatment $id)
    {
        // Set validation
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // If validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Update id
        $id->update($request->all());

        // Return response JSON id is updated
        return response()->json($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Treatment $treatment)
    {
        $treatment->delete();
        return response()->json(['message' => 'Treatment deleted successfully']);
    }

    public function datatables()
    {
        $treatment = Treatment::query();
        return DataTables::of($treatment)
        ->make(true);
        
    }

    public function datatableWeb()
    {
        if (request()->ajax()) {
            $treatments = Treatment::query()->latest();
            return DataTables::of($treatments)

                ->make();
        }
        return view('treatment');
    }
}
