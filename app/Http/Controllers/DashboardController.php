<?php

namespace App\Http\Controllers;

use App\Facades\ApiFacade;
use App\Models\Category;
use App\Models\DoctorAppointment;
use App\Models\DoctorAppointments;
use App\Models\Problem;
use App\Models\Question;
use App\Models\UserProblem;
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

    public function __construct(AiResponseParserService $aiResponseParserService) {
        $this->aiResponseParserService = $aiResponseParserService;
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
            $htmlContent = $this->parseToHtml($responseData);
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
    
                // ===========================================================
                //pass question response type
                $list = $this->aiResponseParserService->getDataListByType('appointments');
                // ===========================================================
    
                // $response = ApiFacade::post($this->url, $params, $headers);
    
                // if(!$response->success){
                //     return response()->json(["message" => "Something went wrong!", "status" => 500], 200);
                // }

                // $responseData = $response->data;
                // $contentObject = $this->parseToHtml($responseData);
    
            } catch (Exception $ex) {
                Log::error($ex->getMessage(). '  ' . $ex->getLine() . ' ' . $ex->getFile());
                return response()->json(["message" => $ex->getMessage(), "status" => 500], 500);
            }
    
            return response()->json([
                "message"=>"Responsed successfully",
                "htmlContent" => "<strong> You can add them for reminder, also modify them anytime.</strong>", 
                "list" => $list, 
                "status" => 200
            ], 200);
    }

    // TODO
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
                return response()->json(["message" => "Something went wrong!", "status" => 500], 200);
            }

            $responseData = $response->data;
            $htmlContent = $this->parseToHtml($responseData);

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

    function parseToHtml($aiResponse)
    {
        $mock = "**I'm not a doctor, but I can share general information about preeclampsia that might be helpful.\n\nPreeclampsia is a pregnancy condition marked by high blood pressure, usually occurring after the 20th week of pregnancy, and it may also involve organ damage, often in the liver or kidneys.** The exact cause of preeclampsia isn't fully understood, but several factors may increase your risk, including:\n\n1. **Placental Issues**: Reduced blood flow to the placenta can trigger high blood pressure and damage the placenta and other organs.\n\n2. **Immune System Factors**: Some theories suggest immune responses may contribute to preeclampsia.\n\n3. **Genetic Predisposition**: A family history of preeclampsia or high blood pressure can increase the risk.\n\nSome key symptoms often associated with preeclampsia include:\n\n- **Severe headaches**\n- **Vision changes** (blurriness, light sensitivity)\n- **Upper abdominal pain** (usually on the right side)\n- **Swelling in the hands and face** (edema)\n- **Sudden weight gain**\n\n### Possible Diagnostic Tests\n**To confirm preeclampsia, your healthcare provider may order tests like:**\n\n- **Blood Pressure Monitoring**: Persistent readings above 140/90 mm Hg.\n- **Urine Test**: For proteinuria (excess protein in urine).\n- **Blood Tests**: To assess liver and kidney function, platelet levels, etc.\n- **Fetal Monitoring**: Ultrasound and non-stress tests to check the baby’s growth and health.\n\n### Suggested Treatments\n**The only definitive treatment for preeclampsia is delivery.** However, the timing depends on how far along the pregnancy is and the severity of the condition. Other management options may include:\n\n- **Medication**: Antihypertensives to lower blood pressure or corticosteroids to help the baby's lungs mature if preterm delivery is necessary.\n- **Regular Monitoring**: Blood pressure checks, urine tests, and ultrasounds to monitor you and the baby.\n- **Bed Rest or Reduced Activity**: If recommended, it can help reduce symptoms.\n- **Hospitalization**: In severe cases, a hospital stay may be necessary to closely monitor and possibly prepare for early delivery.\n\n**If you suspect preeclampsia or experience any of these symptoms, it’s essential to reach out to your healthcare provider right away. Early intervention can make a significant difference in outcomes for both you and your baby.**";
        $text = $aiResponse['candidates'][0]['content']['parts'][0]['text'] ?? $mock;
        Log::info("Ai Response Text: ". $text);

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
