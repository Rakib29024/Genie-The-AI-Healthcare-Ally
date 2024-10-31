<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('questions')->insert([
            [
                'response_type' => 'appointments',
                'user_question' => 'Looking for Next Appointments',
                'ai_prompt' => "So, when should I take visit the doctor? give me the further appointment list."
            ],
            [
                'response_type' => 'food',
                'user_question' => 'Looking for Food Suggestions',
                'ai_prompt' => "So, what kind of food or fruits should I eat daily to prevent the problem or helps me to recover my health condition? give me a list."
            ],
            [
                'response_type' => 'medicine',
                'user_question' => 'Looking for Food Suggestions',
                'ai_prompt' => "So, which medicine should I take to cure? give me a list."
            ],
        ]);
    }
}
