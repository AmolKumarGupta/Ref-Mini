<?php

namespace App\Traits;

trait ConvertTime 
{
    /**
     * convert seconds to HH:MM
     */
    public function toHourString(string|int|null $seconds): string
    {
        $seconds = (int) $seconds;
        $hrs = (string) floor($seconds / 3600);
        $hrs = str_pad($hrs, 2, '0', STR_PAD_LEFT);

        $lefted = (int) $seconds % 3600;
        $mins = (string) floor($lefted / 60);
        $mins = str_pad($mins, 2, '0', STR_PAD_LEFT);

        return "$hrs:$mins";
    }

    /**
     * convert HH:MM to seconds
     * @return int seconds
     */
    public function hourStringToSeconds(string $hourString): int
    {
        $timeString = explode(':', (string) $hourString);
        $hrs = (int) $timeString[0] * 3600;
        $mins = (int) $timeString[1] * 60;
        return $hrs + $mins;
    }

}