<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProblemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $problems = [
            // Menstrual Disorders
            ['category_id' => 1, 'title' => 'Dysmenorrhea', 'description' => 'Severe menstrual cramps causing discomfort.'],
            ['category_id' => 1, 'title' => 'Polycystic Ovary Syndrome (PCOS)', 'description' => 'A hormonal disorder causing enlarged ovaries with small cysts.'],
            
            // Pregnancy Complications
            ['category_id' => 2, 'title' => 'Gestational Diabetes', 'description' => 'High blood sugar levels during pregnancy.'],
            ['category_id' => 2, 'title' => 'Preeclampsia', 'description' => 'A pregnancy condition characterized by high blood pressure.'],
            
            // Menopause and Hormonal Changes
            ['category_id' => 3, 'title' => 'Hot Flashes', 'description' => 'Sudden feeling of warmth, often intense.'],
            ['category_id' => 3, 'title' => 'Osteoporosis', 'description' => 'A condition of weak and brittle bones common after menopause.'],
            
            // Gynecological Issues
            ['category_id' => 4, 'title' => 'Endometriosis', 'description' => 'Tissue similar to the uterine lining grows outside the uterus.'],
            ['category_id' => 4, 'title' => 'Ovarian Cysts', 'description' => 'Fluid-filled sacs on the ovaries.'],
            
            // Sexual Health Issues
            ['category_id' => 5, 'title' => 'Vaginismus', 'description' => 'Involuntary contractions of vaginal muscles causing pain.'],
            ['category_id' => 5, 'title' => 'Chlamydia Infection', 'description' => 'A sexually transmitted bacterial infection.'],

            // Mental Health and Well-being
            ['category_id' => 6, 'title' => 'Postpartum Depression', 'description' => 'Depression following childbirth.'],
            ['category_id' => 6, 'title' => 'Anxiety Disorders', 'description' => 'Feelings of excessive fear or worry.'],
        ];

        DB::table('problems')->insert($problems);
    }
}
