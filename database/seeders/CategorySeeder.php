<?php

namespace Database\Seeders;

use App\Models\Category;
use Colors\RandomColor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            "exercise",
            "coding session",
            "work from home",
            "office work",
            "entertainment",
            "shopping"
        ];

        $data = [];
        foreach ($names as $name) {
            $color = RandomColor::one(["luminosity" => "dark"]);

            $data[] = [
                "name" => $name,
                "slug" => Str::slug($name),
                "color" => $color,
                "bgcolor" => $color . "36"
            ];
        }

        Category::insert($data);
    }
}
