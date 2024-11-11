<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = [
        'user_problem_id',
        "name",
        "quantity",
        "unit",
        "frequency"
    ];
}
