<?php

namespace App\Models;

use App\Traits\LogData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuSection extends Model
{
    use HasFactory, SoftDeletes, LogData;

    public function menu(): HasMany
    {
        return $this->hasMany(related: Menu::class, foreignKey: 'fk_section_id', localKey: 'id');
    }
}
