<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Menstrual Disorders', 'description' => 'Issues related to the menstrual cycle, such as heavy bleeding, irregular periods, or dysmenorrhea.'],
            ['name' => 'Pregnancy Complications', 'description' => 'Health problems that occur during pregnancy like gestational diabetes or preeclampsia.'],
            ['name' => 'Menopause and Hormonal Changes', 'description' => 'Symptoms and complications associated with menopause and hormonal changes.'],
            ['name' => 'Gynecological Issues', 'description' => 'Problems involving the reproductive organs like ovarian cysts or endometriosis.'],
            ['name' => 'Sexual Health Issues', 'description' => 'Problems affecting sexual function, such as vaginismus or STDs.'],
            ['name' => 'Mental Health and Well-being', 'description' => 'Mental health challenges like postpartum depression or anxiety disorders.'],
        ];

        DB::table('categories')->insert($categories);
    }
}
