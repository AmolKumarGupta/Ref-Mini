<?php

namespace App\Models;

use App\Traits\LogData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gist extends Model
{
    use HasFactory, LogData;
}
