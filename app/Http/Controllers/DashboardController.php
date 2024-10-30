<?php

namespace App\Http\Controllers;

use App\Facades\ApiFacade;
use App\Models\Category;
use App\Models\DoctorAppointment;
use App\Models\DoctorAppointments;
use App\Models\Problem;
use App\Models\UserProblem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{

    protected $apiKey;
    protected $url;

    public function __construct() {
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
        $problemString = $problem->title.', '.$request->details ?? $problem->description;
        $prompt = "I need a detailed response on a womens health issue. The issue is:".$problemString.". Please structure the response as follows: 1. Overview 2. Common Symptoms 3. Causes and Risk Factors 4. Impact on Health 5. Diagnosis 6. Treatment Options 7. Preventive Measures";

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

            Log::info("Health Issue Details AI Responsed Successfully". json_encode($response->data));
            $responseData = $response->data;
            $htmlContent = $this->parseToHtml($responseData);
            Log::info("AI Responsed Data Parsed Successfully");

            if(!$htmlContent){
                return response()->json(["message" => "Ai response error", "status" => 500], 200);
            }

            // Insert user problem
            $userProblem = UserProblem::create([
                "user_id" => auth()->id(),
                "category_id" => $request->category_id, 
                "problem_id" => $request->problem_id,
                "details"=> $problemString,
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
                    "details"=> $problemString,
                    "appointment_date" => $request->appointment_date,
                    "appointment_time" => $request->appointment_time,
                    "status" => 1
                ]);
                Log::info("Doctor Appointment Inseretd Successfully");
            }

            $questionList = [
                "Should I visit doctor?",
                "When should i visited doctor?",
                "What food should I eat?",
                "Which medicine should i continue?"
            ];

            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error($ex->getMessage(). '  ' . $ex->getLine() . ' ' . $ex->getFile());
            return response()->json(["message" => "Something went wrong", "status" => 500], 500);
        }

        return response()->json(["htmlContent" => $htmlContent, "questionList" => $questionList,"status" => 200], 200);
    }

    public function aiChat()
    {
        try {

            $headers = [];
            $params = [
                'contents' => [
                    [
                        "role" => "user",
                        "parts" => [
                            ["text" => "Hello"]
                        ]
                    ],
                    [
                        "role" => "model",
                        "parts" => [
                            ["text" => "Great to meet you. What would you like to know?"]
                        ]
                    ],
                    [
                        "role" => "user",
                        "parts" => [
                            ["text" => "I have two dogs in my house. How many paws are in my house?"]
                        ]
                    ]
                ]
            ];

            $response = ApiFacade::post($this->url, $params, $headers);

            if(!$response->success){
                return response()->json(["error" => $response->message]);
            }

            $responseData = $response->data;
            $htmlContent = $this->parseToHtml($responseData);

        } catch (Exception $ex) {
            Log::error($ex->getMessage(). '  ' . $ex->getLine() . ' ' . $ex->getFile());
            $htmlContent = "<strong>".$ex->getMessage()."</strong>";
        }

        return response()->json(["htmlContent" => $htmlContent], 200);
    }

    function parseToHtml($aiResponse)
    {
        $text = $aiResponse['candidates'][0]['content']['parts'][0]['text'] ?? null;
        if(!$text) return null;
        $text = preg_replace('/##\s*(.*)/', '<h2>$1</h2>', $text);
        $text = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $text);
        $text = preg_replace('/\*(.*?)\*/', '<em>$1</em>', $text);
        $paragraphs = explode("\n\n", trim($text));
        $html = '';
        foreach ($paragraphs as $para) {
            if (preg_match('/^\s*[*-]\s/', $para)) {
                $html .= '<ul>';
                $lines = explode("\n", $para);
                foreach ($lines as $line) {
                    $html .= '<li>' . preg_replace('/^\s*[*-]\s*/', '', $line) . '</li>';
                }
                $html .= '</ul>';
            } else {
                $html .= '<p>' . $para . '</p>';
            }
        }

        return $html!='' ? '<div class="ai-overview grid gap-2">' . $html . '</div>' : null;
    }
    
}
