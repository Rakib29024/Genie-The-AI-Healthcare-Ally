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
        return $this->$type($data['content']['data']);
        // if (isset($data['content']['type']) && $data['content']['type'] === $type) {
        //     return response()->json($data['content']['data']);
        // } else {
        //     return response()->json(['error' => 'Invalid type'], 400);
        // }
    }

    public function appointments($data){
        $html = view('list-view.appointments', ['list' => $data])->render();
        return $html;
    }
    public function medicine(){}
    public function food(){}
}