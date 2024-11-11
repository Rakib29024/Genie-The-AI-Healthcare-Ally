<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * Get the category that owns the UserProblem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Get the problem that owns the UserProblem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function problem(): BelongsTo
    {
        return $this->belongsTo(Problem::class, 'problem_id');
    }

    /**
     * Get all of the appointments for the UserProblem
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(DoctorAppointment::class);
    }

    /**
     * Get all of the foods for the UserProblem
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function foods(): HasMany
    {
        return $this->hasMany(Food::class);
    }
    
    /**
     * Get all of the medicines for the UserProblem
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medicines(): HasMany
    {
        return $this->hasMany(Medicine::class);
    }
}
