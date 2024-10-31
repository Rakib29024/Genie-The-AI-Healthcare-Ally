<?php

namespace App\Http\Controllers;

use App\Models\DoctorAppointments;
use App\Http\Requests\StoreDoctorAppointmentsRequest;
use App\Http\Requests\UpdateDoctorAppointmentsRequest;
use App\Models\DoctorAppointment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DoctorAppointmentController extends Controller
{
    public function index(Request $request)
    {
        try {
            $data = DoctorAppointment::orderBy('created_at', 'DESC')->paginate(5);
        } catch (Exception $ex) {
            Log::error($ex->getMessage(). '  ' . $ex->getLine() . ' ' . $ex->getFile());
            return response()->json(["message" => $ex->getMessage(),"status" => 500], 500);
        }

        return response()->json(["appointments" => $data,"status" => 200], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDoctorAppointmentsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DoctorAppointments $doctorAppointments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DoctorAppointments $doctorAppointments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDoctorAppointmentsRequest $request, DoctorAppointments $doctorAppointments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DoctorAppointments $doctorAppointments)
    {
        //
    }
}
