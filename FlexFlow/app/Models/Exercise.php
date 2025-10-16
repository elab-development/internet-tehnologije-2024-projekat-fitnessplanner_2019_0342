<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'targeted_muscle',
        'video_url'
    ];

    public function workouts() {
        return $this->belongsToMany(Workouts::class)->withPivot(['sets', 'reps']);
    }

}
