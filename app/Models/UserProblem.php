<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProblem extends Model
{
    protected $fillable = [
        'user_id',         // Foreign key for the user
        'category_id',     // Foreign key for the category
        'problem_id',      // Foreign key for the problem
        'details',         // Details of the problem
        'ai_response',     // AI response
        'status',          // Status of the problem (e.g., active, inactive)
    ];
}
