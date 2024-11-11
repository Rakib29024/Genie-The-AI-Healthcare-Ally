<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Http\Requests\StoreFoodRequest;
use App\Http\Requests\UpdateFoodRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $user_problem_id = null)
    {
        try {
            $data = Food::orderBy('created_at', 'DESC');

            if($user_problem_id) {
                $data = $data->where('user_problem_id', $user_problem_id);
            }
            
            $data = $data->paginate(5)->through(function ($food) {
                // $food->statusLabel = AppointmentStatusEnum::label($food->status);
                return $food;
            });
            
        } catch (Exception $ex) {
            Log::error($ex->getMessage(). '  ' . $ex->getLine() . ' ' . $ex->getFile());
            return response()->json(["message" => $ex->getMessage(),"status" => 500], 500);
        }

        return response()->json(["foods" => $data,"status" => 200], 200);
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
            Log::info("Food Request Data: ". json_encode($request->all()));
            $data = Food::create([
                'user_problem_id' => $request->user_problem_id,
                'name' => $request->data['name'],
                "quantity"=> $request->data['quantity'],
                "unit"=> $request->data['unit'],
                "description"=> $request->data['description'],
                "category"=> $request->data['category'],
                "calories"=> $request->data['calories'],
                "protein"=> $request->data['protein'],
                "fat"=> $request->data['fat'],
                "carbohydrates"=> $request->data['carbohydrates'],
                "is_vegan"=> $request->data['is_vegan'],
                "is_gluten_free"=> $request->data['is_gluten_free'],
                "allergens"=> $request->data['allergens'],
                "origin"=> $request->data['origin']
            ]);
            Log::info("Food Created Successfully with: ". json_encode($data));
        } catch (Exception $ex) {
            Log::error($ex->getMessage(). '  ' . $ex->getLine() . ' ' . $ex->getFile());
            return response()->json(["message" => "Something went wrong", "status" => 500], 500);
        }

        return response()->json([
            "message"=> "Food Added Successfully", 
            "status" => 200
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Food $food)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Food $food)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFoodRequest $request, Food $food)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        //
    }
}
