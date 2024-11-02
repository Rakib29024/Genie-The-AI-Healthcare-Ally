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

    function parseToJsonArray($aiResponse)
    {
        $mock = '[{"date": "08-03-2024"}, {"date": "15-03-2024"}, {"date": "22-03-2024"}, {"date": "29-03-2024"}]';
        $text = $aiResponse['candidates'][0]['content']['parts'][0]['text'] ?? $mock;
        Log::info("Ai Response Text: ". $text);

        if(!$text) return [];

        $jsonArray = json_decode($text, true);

        return $jsonArray;
    }
}