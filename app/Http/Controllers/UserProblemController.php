<?php

namespace App\Http\Controllers;

use App\Models\UserProblem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserProblemController extends Controller
{
    public function index(Request $request)
    {
        try {
            $data = UserProblem::orderBy('created_at', 'DESC')->paginate(2);
        } catch (Exception $ex) {
            Log::error($ex->getMessage(). '  ' . $ex->getLine() . ' ' . $ex->getFile());
            return response()->json(["message" => $ex->getMessage(),"status" => 500], 500);
        }

        return response()->json(["userProblems" => $data,"status" => 200], 200);
    }
}
