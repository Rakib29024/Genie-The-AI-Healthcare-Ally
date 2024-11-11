<?php

namespace App\Http\Controllers;

use App\Enums\AppointmentStatusEnum;
use App\Models\DoctorAppointments;
use App\Http\Requests\StoreDoctorAppointmentsRequest;
use App\Http\Requests\UpdateDoctorAppointmentsRequest;
use App\Models\DoctorAppointment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DoctorAppointmentController extends Controller
{
    public function index(Request $request, $user_problem_id = null)
    {
        try {
            $data = DoctorAppointment::orderBy('created_at', 'DESC')->with(['user_problem.problem.category']);

            if($user_problem_id) {
                $data = $data->where('user_problem_id', $user_problem_id);
            }
            
            $data = $data->paginate(5)->through(function ($appointment) {
                $appointment->statusLabel = AppointmentStatusEnum::label($appointment->status);
                return $appointment;
            });
            
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
    public function store(Request $request){
        try {
            Log::info("Appointment Request Data: ". json_encode($request->all()));
            $data = DoctorAppointment::create([
                'user_problem_id' => $request->user_problem_id,
                'user_id' => auth()->id(),
                'appointment_date' => $request->date,
                'status' => AppointmentStatusEnum::PENDING
            ]);
            Log::info("Appointment Created Successfully with: ". json_encode($data));
        } catch (Exception $ex) {
            Log::error($ex->getMessage(). '  ' . $ex->getLine() . ' ' . $ex->getFile());
            return response()->json(["message" => "Something went wrong", "status" => 500], 500);
        }

        return response()->json([
            "message"=> "Appointment Created Successfully", 
            "status" => 200
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(DoctorAppointment $doctorAppointments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DoctorAppointment $doctorAppointments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDoctorAppointmentsRequest $request, DoctorAppointment $doctorAppointments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DoctorAppointment $doctorAppointments)
    {
        //
    }
}
