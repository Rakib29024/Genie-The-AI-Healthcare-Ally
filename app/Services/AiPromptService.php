<?php
namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;

class AiPromptService
{
    public function get($text)
    {
        // return (object) [
        //     'contents' => [
        //         [
        //             'parts' => [
        //                 [
        //                     'text' => 'List a few popular cookie recipes using this JSON schema:
        
        //                         Recipe = {"recipe_name": str}
        //                         Return: list[Recipe]'
        //                 ]
        //             ]
        //         ]
        //     ],
        //     'generationConfig' => [
        //         'response_mime_type' => 'application/json'
        //     ]
        // ];
    }

    public function getWithJsonFormatQAPrompt($request,$question)
    {
        $aiChatPromptContent = $this->aiChatHistoryParser($request);

        if($question->response_type == "appointments"){
            $listPrompt = [[
                "role" => "user",
                'parts' => [
                    [
                        'text' => $question->ai_prompt.'
    
                            Recipe = {"date": str}
                            Return: list[Recipe]'
                    ]
                ]]
            ];
        }else if($question->response_type == "food"){
            $listPrompt = [[
                "role" => "user",
                'parts' => [
                    [
                        'text' => $question->ai_prompt.'
    
                            Recipe = {
                                "name": "str",
                                "quantity": "int",
                                "unit": "str",
                                "description": "str",
                                "category": "str",
                                "calories": "str",
                                "protein": "str",
                                "fat": "str",
                                "carbohydrates": "str",
                                "is_vegan": "int",
                                "is_gluten_free": "int",
                                "allergens": "str",
                                "origin": "str"
                            }
                            Return: list[Recipe]'
                    ]
                ]]
            ];
        }else if($question->response_type == "medicine"){
            $listPrompt = [[
                "role" => "user",
                'parts' => [
                    [
                        'text' => $question->ai_prompt.'
    
                            Recipe = {
                                "name": "str",
                                "quantity": "int",
                                "unit": "str",
                                "frequency": "str"
                            }
                            Return: list[Recipe]'
                    ]
                ]]
            ];
        }

        $aiPrompt = array_merge($aiChatPromptContent, $listPrompt);

        return (object) [
            'contents' => [
                $aiPrompt
            ],
            'generationConfig' => [
                'response_mime_type' => 'application/json'
            ]
        ];
    }

    public function getWithAllJsonFormat($text)
    {

        // return [
        //     'contents' => [
        //         [
        //             'parts' => [
        //                 [
        //                     'text' => 'List 5 popular cookie recipes'
        //                 ]
        //             ]
        //         ]
        //     ],
        //     'generationConfig' => [
        //         'response_mime_type' => 'application/json',
        //         'response_schema' => [
        //             'type' => 'ARRAY',
        //             'items' => [
        //                 'type' => 'OBJECT',
        //                 'properties' => [
        //                     'recipe_name' => [
        //                         'type' => 'STRING',
        //                     ],
        //                 ],
        //             ],
        //         ],
        //     ],
        // ];
    }

    public function aiChatHistoryParser($request)
    {
        $chats = $request->chatHistorry;
        $formattedMessages = array_map(function($message) {
            return [
                "role" => $message["ai"] ? "model" : "user",
                "parts" => [
                    ["text" => $message["content"]]
                ]
            ];
        }, $chats);

        return $formattedMessages;
    }
    
}