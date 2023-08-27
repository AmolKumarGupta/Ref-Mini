<?php

namespace App\Models;

use App\Traits\LogData;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Models\Activity;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, LogData;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'location',
        'about_me',
        'github_username',
        'gists_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * get relative time of last loggedin.
     */
    public function lastLogin(): string
    {
        $activity = Activity::where('log_name', 'login')
            ->where('causer_id', auth()->id())
            ->where('causer_type', self::class)
            ->orderBy('id', 'DESC')
            ->skip(1)
            ->first();

        if (!$activity) {
            return 'N/A';
        }

        return Carbon::parse($activity->created_at)->diffForHumans(
            now(),
            CarbonInterface::DIFF_RELATIVE_AUTO,
            true
        );
    }
}
