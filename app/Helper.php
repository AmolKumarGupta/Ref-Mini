<?php 

namespace App;

use Carbon\Carbon;

class Helper
{

    public function __construct(protected array $config) {}

    public function datetime(string $date): string 
    {
        return Carbon::parse($date)->format($this->config['format']['datetime']);
    }

}