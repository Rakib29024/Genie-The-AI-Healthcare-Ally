<?php

namespace App\Http\Controllers;

use App\Models\DoctorAppointments;
use App\Http\Requests\StoreDoctorAppointmentsRequest;
use App\Http\Requests\UpdateDoctorAppointmentsRequest;

class DoctorAppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
