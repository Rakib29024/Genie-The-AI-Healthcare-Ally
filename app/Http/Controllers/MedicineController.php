<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Http\Requests\StoreMedicineRequest;
use App\Http\Requests\UpdateMedicineRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $user_problem_id = null)
    {
        try {
            $data = Medicine::orderBy('created_at', 'DESC');

            if($user_problem_id) {
                $data = $data->where('user_problem_id', $user_problem_id);
            }
            
            $data = $data->paginate(5)->through(function ($medecine) {
                // $medecine->statusLabel = AppointmentStatusEnum::label($medecine->status);
                return $medecine;
            });
            
        } catch (Exception $ex) {
            Log::error($ex->getMessage(). '  ' . $ex->getLine() . ' ' . $ex->getFile());
            return response()->json(["message" => $ex->getMessage(),"status" => 500], 500);
        }

        return response()->json(["medecines" => $data,"status" => 200], 200);
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
            Log::info("Medicine Request Data: ". json_encode($request->all()));
            $data = Medicine::create([
                'user_problem_id' => $request->user_problem_id,
                'name' => $request->data['name'],
                'quantity' => $request->data['quantity'],
                'unit' => $request->data['unit'],
                'frequency' => $request->data['frequency']
            ]);
            Log::info("Medicine Created Successfully with: ". json_encode($data));
        } catch (Exception $ex) {
            Log::error($ex->getMessage(). '  ' . $ex->getLine() . ' ' . $ex->getFile());
            return response()->json(["message" => "Something went wrong", "status" => 500], 500);
        }

        return response()->json([
            "message"=> "Medicine Added Successfully", 
            "status" => 200
        ], 200);
    }
    /**
     * Display the specified resource.
     */
    public function show(Medicine $medicine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medicine $medicine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedicineRequest $request, Medicine $medicine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicine $medicine)
    {
        //
    }
}
