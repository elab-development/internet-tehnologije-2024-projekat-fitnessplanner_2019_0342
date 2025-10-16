<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workouts extends Model
{
    use HasFactory;

    protected $fillable = [
        'userid',
        'date',
        'notes'
    ];

    public function exercises(){
        return $this->belongsToMany(Exercise::class)->withPivot(['sets', 'reps']);
    }
    
}
