<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HabitTrack extends Model
{
    use HasFactory;

    public function habit_category()
    {
        return $this->hasOne(HabitCategory::class);
    }

    public function category()
    {
        return $this->hasOneThrough(Category::class, HabitCategory::class, "habit_track_id", "id");
    }
}
