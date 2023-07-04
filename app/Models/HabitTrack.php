<?php

namespace App\Models;

use App\Traits\LogData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int|string $category_id
 * @property string|int|null $time
 */
class HabitTrack extends Model
{
    use HasFactory, LogData;

    protected $fillable = [
        'name',
        'description',
        'time',
        'date',
    ];

    public function habit_category()
    {
        return $this->hasOne(HabitCategory::class);
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\HasOneThrough
    {
        return $this->hasOneThrough(Category::class, HabitCategory::class, 'habit_track_id', 'id', 'id', 'category_id');
    }
}
