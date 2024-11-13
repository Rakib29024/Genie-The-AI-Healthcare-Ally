<?php

namespace App\Http\Controllers;

use App\Enums\AppointmentStatusEnum;
use App\Models\UserProblem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserProblemController extends Controller
{
    public function index(Request $request)
    {
        try {
            $data = UserProblem::orderBy('created_at', 'DESC')->withCount(['appointments','foods','medicines'])->with(['category','problem'])->where('user_id', auth()->id())->paginate(5);
        } catch (Exception $ex) {
            Log::error($ex->getMessage(). '  ' . $ex->getLine() . ' ' . $ex->getFile());
            return response()->json(["message" => $ex->getMessage(),"status" => 500], 500);
        }

        return response()->json(["userProblems" => $data,"status" => 200], 200);
    }

    public function details($id)
    {
        try {
            $data['user_problem'] = UserProblem::where('id', $id)
                                    ->withCount(['appointments','foods','medicines'])
                                    ->with(['category','problem','appointments' => function($apppointment){
                                        // $apppointment->statusLabel = AppointmentStatusEnum::label($apppointment->status);
                                        return $apppointment;
                                    },'foods','medicines'])->first();
                                    
            if(!$data['user_problem']){
                return redirect()->back()->with('error', "Health Issue Not Found.");
            }

            return view('user_problem.details', $data);
        } catch (Exception $ex) {
            Log::error($ex->getMessage(). '  ' . $ex->getLine() . ' ' . $ex->getFile());
            return redirect()->back()->with('error', "Something went wrong!");
        }

        return response()->json(["userProblems" => $data,"status" => 200], 200);
    }
}
