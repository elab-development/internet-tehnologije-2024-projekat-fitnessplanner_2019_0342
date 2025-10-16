<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Meal extends Model
{

    protected $fillable = [
        'userid',
        'date',
        'meal_name',
        'weight',

    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Meal::class, 'userid', 'userid');
    }

    use HasFactory;
}
