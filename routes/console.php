<?php

use App\Models\Category;
use Colors\RandomColor;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('make:category {name}', function ($name) {
    try {
        $color = RandomColor::one(['luminosity' => 'dark']);
        Category::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'color' => $color,
            'bgcolor' => $color . '36',
        ]);
        $this->info('Category created!');
    } catch (Exception $e) {
        $this->error('Something went wrong!');
    }
})->purpose('Make a general category');
