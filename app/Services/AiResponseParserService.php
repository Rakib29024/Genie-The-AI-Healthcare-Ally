<?php
namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;

class AiResponseParserService
{
    public function getDataListByType($type){
        $file = "dictionary/{$type}.json";
        $path = base_path($file);
        
        if (!file_exists($path)) {
            return response()->json(['error' => 'File not found'], 404);
        }
        $jsonContent = file_get_contents($path);
        $data = json_decode($jsonContent, true);

        return $data['content']['data'];
    }

    public function appointments($data){
        $html = view('list-view.appointments', ['list' => $data])->render();
        return $html;
    }
    public function medicine(){}
    public function food(){}

    function parseToHtml($aiResponse)
    {
        $responseContent = $aiResponse['candidates'][0]['content']['parts'][0]['text'];
        Log::info("Ai Response: ". $responseContent);
        $mock = "**I'm not a doctor, but I can help you when you should see your doctor.**";
        $text = $responseContent ?? $mock;
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

    function parseToJsonArray($aiResponse)
    {
        $text = $aiResponse['candidates'][0]['content']['parts'][0]['text'] ?? null;
        Log::info("Ai Response Text: ". $text);

        if(!$text) return [];

        $jsonArray = json_decode($text, true);

        return $jsonArray;
    }
}