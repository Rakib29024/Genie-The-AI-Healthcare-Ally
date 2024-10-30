<?php
namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;

class AiPromptService
{
    public function get($text)
    {
        return (object) [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => 'List a few popular cookie recipes using this JSON schema:
        
                                Recipe = {"recipe_name": str}
                                Return: list[Recipe]'
                        ]
                    ]
                ]
            ],
            'generationConfig' => [
                'response_mime_type' => 'application/json'
            ]
        ];
    }

    public function getWithJsonFormat($text)
    {
        return (object) [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => 'List a few popular cookie recipes using this JSON schema:
        
                                Recipe = {"recipe_name": str}
                                Return: list[Recipe]'
                        ]
                    ]
                ]
            ],
            'generationConfig' => [
                'response_mime_type' => 'application/json'
            ]
        ];
    }

    public function getWithAllJsonFormat($text)
    {

        return [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => 'List 5 popular cookie recipes'
                        ]
                    ]
                ]
            ],
            'generationConfig' => [
                'response_mime_type' => 'application/json',
                'response_schema' => [
                    'type' => 'ARRAY',
                    'items' => [
                        'type' => 'OBJECT',
                        'properties' => [
                            'recipe_name' => [
                                'type' => 'STRING',
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }

    public function getChat($textArray)
    {
        return (object) [
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
    }
    
}