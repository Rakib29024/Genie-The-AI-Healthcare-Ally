<?php
namespace App\Services;

use App\Entity\API\ApiResponseEntity;
use App\Facades\ApiError;
use Exception;
use Illuminate\Support\Facades\Log;

class RestApiService
{
    public function get($url, $params = [], $headers = [])
    {
        $response = new ApiResponseEntity();

        try {
            $response->data = $this->makeRequest('get', $url, $params, $headers);
            $response->status = 200;
            $response->message = "Success";
        } catch (Exception $e) {
            Log::error("API Request failed: {$e->getMessage()}");
            $response->success = false;
            $response->message = "Something went wrong!";
            return $response;
        }

        return $response;
    }

    public function post($url, $data = [], $headers = [])
    {
        $response = new ApiResponseEntity();

        try {
            $response->data = $this->makeRequest('POST', $url, $data, $headers);
            $response->status = 200;
            $response->message = "Success";
            $response->success = true;
        } catch (Exception $e) {
            Log::error("API Request failed: {$e->getMessage()}");
            $response->success = false;
            $response->message = "Something went wrong!";
            return $response;
        }

        return $response;
    }

    private function makeRequest($method, $url, $data, $headers)
    {
        $ch = curl_init($url);

        $defaultHeaders = [
            'Content-Type: application/json',
        ];

        $headers = array_merge($defaultHeaders, $headers);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        } else {
            if (!empty($data)) {
                $url .= '?' . http_build_query($data);
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }

        $response = curl_exec($ch);
        
        if (curl_errno($ch)) {
            Log::error('cURL error: ' . curl_error($ch));
            return [];
        }

        curl_close($ch);

        return json_decode($response, true);

    }
}