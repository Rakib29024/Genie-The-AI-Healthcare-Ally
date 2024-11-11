<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable = [
        'user_problem_id',
        "name",
        "quantity",
        "unit",
        "description",
        "category",
        "calories",
        "protein",
        "fat",
        "carbohydrates",
        "is_vegan",
        "is_gluten_free",
        "allergens",
        "origin"
    ];

}
