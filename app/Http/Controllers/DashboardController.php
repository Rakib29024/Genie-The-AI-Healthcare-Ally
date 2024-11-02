<?php

namespace App\Http\Controllers;

use App\Facades\ApiFacade;
use App\Models\Category;
use App\Models\DoctorAppointment;
use App\Models\DoctorAppointments;
use App\Models\Problem;
use App\Models\Question;
use App\Models\UserProblem;
use App\Services\AiPromptService;
use App\Services\AiResponseParserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{

    protected $apiKey;
    protected $url;
    protected $aiResponseParserService;
    protected $aiPromptService;

    public function __construct(AiResponseParserService $aiResponseParserService, AiPromptService $aiPromptService) {
        $this->aiResponseParserService = $aiResponseParserService;
        $this->aiPromptService = $aiPromptService;
        $this->apiKey = env('GOOGLE_API_KEY');
        $this->url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key={$this->apiKey}";
    }

    public function index()
    {
        $data['categories'] = Category::all();
        return view('dashboard', $data);
    }

    public function categoryToProblems(Request $request)
    {
        try {
            $data = Problem::where('category_id', $request->categoryId)->get();
        } catch (Exception $ex) {
            Log::error($ex->getMessage(). '  ' . $ex->getLine() . ' ' . $ex->getFile());
            $data = [];
        }

        return response()->json(["data" => $data], 200);
    }

    public function healthIssueInfoStore(Request $request){

        $problem = Problem::findOrFail($request->problem_id);
        $details = $request->details ? $request->details : $problem->description;
        $prompt = "I am experiencing ".$problem->title.($details ? (" along with ".$details) : '').". Can you provide information about what might be causing these symptoms, possible diagnoses, and suggested treatments?";

        Log::info("Health Issue Details Prompt: ". json_encode($prompt));
        DB::beginTransaction();
        try {
            $headers = [];
            $params = [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ];

            $response = ApiFacade::post($this->url, $params, $headers);

            if(!$response->success){
                return response()->json(["error" => $response->message]);
            }

            Log::info("Health Issue Details AI Responsed Successfully: ". json_encode($response->data));
            $responseData = $response->data;
            $htmlContent = $this->aiResponseParserService->parseToHtml($responseData);
            Log::info("AI Responsed Data Parsed Successfully: ". json_encode($htmlContent));

            if(!$htmlContent){
                return response()->json(["message" => "Ai response error", "status" => 500], 200);
            }

            // Insert user problem
            $userProblem = UserProblem::create([
                "user_id" => auth()->id(),
                "category_id" => $request->category_id, 
                "problem_id" => $request->problem_id,
                "details"=> $details,
                "ai_response" => json_encode($responseData),
                "status" => 1
            ]);
            Log::info("User Problem Inseretd Successfully");

            // Insert recent appointment if required
            if($request->visited_doctor && $userProblem){
                DoctorAppointment::create([
                    "user_problem_id" => $userProblem->id,
                    "user_id" => auth()->id(),
                    "problem_id" => $request->problem_id,
                    "details"=> $details,
                    "appointment_date" => $request->appointment_date,
                    "appointment_time" => $request->appointment_time,
                    "status" => 1
                ]);
                Log::info("Doctor Appointment Inseretd Successfully");
            }

            $questionList = Question::all();

            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error($ex->getMessage(). '  ' . $ex->getLine() . ' ' . $ex->getFile());
            return response()->json(["message" => "Something went wrong", "status" => 500], 500);
        }

        return response()->json([
            "message"=> "Your Health Issue has been Received by AI", 
            "userProblemId" => $userProblem->id,
            "htmlContent" => $htmlContent, 
            "questionList" => $questionList,
            "status" => 200
        ], 200);
    }

    // TODO
    public function aiFormat(Request $reqest)
    {
            try {
                // get question here
                $question = Question::where('id',$reqest->questionId)->first();

                if(!$question){
                    return response()->json(["message" => "Question not found.", "status" => 404], 500);
                }
                
                $headers = [];
                $params = $this->aiPromptService->getWithJsonFormatQAPrompt($reqest, $question);
                $response = ApiFacade::post($this->url, $params, $headers);

                // ===========================================================
                // $list = $this->aiResponseParserService->getDataListByType('appointments');
                // ===========================================================
    
                if(!$response->success){
                    return response()->json(["message" => "Something went wrong!", "status" => 500], 200);
                }

                $responseData = $response->data;
                $list = $this->aiResponseParserService->parseToJsonArray($responseData);
    
            } catch (Exception $ex) {
                Log::error($ex->getMessage(). '  ' . $ex->getLine() . ' ' . $ex->getFile());
                return response()->json(["message" => $ex->getMessage(), "status" => 500], 500);
            }
    
            return response()->json([
                "message"=>"Responsed successfully",
                "htmlContent" => "", 
                "list" => $list, 
                "type" => $question->response_type,
                "status" => 200
            ], 200);
    }

    public function aiChat(Request $reqest)
    {
        try {
            $aiPromptContent = $this->aiPromptService->aiChatHistoryParser($reqest);
            $headers = [];
            $params = [
                'contents' => $aiPromptContent
            ];
            $response = ApiFacade::post($this->url, $params, $headers);

            if(!$response->success){
                return response()->json(["message" => "Something went wrong!", "status" => 500], 200);
            }

            $responseData = $response->data;
            $htmlContent = $this->aiResponseParserService->parseToHtml($responseData);

        } catch (Exception $ex) {
            Log::error($ex->getMessage(). '  ' . $ex->getLine() . ' ' . $ex->getFile());
            $htmlContent = "<strong>".$ex->getMessage()."</strong>";
            return response()->json(["message" => $ex->getMessage(), "status" => 500], 500);
        }

        return response()->json([
            "message"=>"Responsed successfully",
            "htmlContent" => $htmlContent, 
            "status" => 200
        ], 200);
    }
}
