<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuSection;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menuSections = [
            ['name' => 'home'],
            ['name' => 'system'],
            ['name' => 'portfolio'],
            ['name' => 'Habit Tracker'],
        ];

        $menus = [
            'home' => [
                [
                    'name' => 'dashboard',
                    'url' => 'dashboard',
                    'icon' => 'fa-home',
                ],
            ],
            'system' => [
                [
                    'name' => 'menu',
                    'url' => 'menu',
                    'icon' => 'fa-flag',
                ],
                [
                    'name' => 'profile',
                    'url' => 'user-profile',
                    'icon' => 'fa-user-edit',
                ],
            ],
            'portfolio' => [
                [
                    'name' => 'Repositories',
                    'url' => 'portfolio/repos',
                    'icon' => 'fa-github',
                ],
            ],
            'Habit Tracker' => [
                [
                    'name' => 'Tracker',
                    'url' => 'habit-tracker',
                    'icon' => 'fa-chart-line',
                ],
            ],
        ];

        MenuSection::insert($menuSections);

        $menuItems = [];
        $menuKeys = array_keys($menus);
        $menuSection = MenuSection::whereIn('name', $menuKeys)->get();
        foreach ($menuSection as $section) {
            if (!array_key_exists($section->name, $menus)) {
                continue;
            }

            foreach ($menus[$section->name] as $singleMenu) {
                $data = $singleMenu;
                $data['fk_section_id'] = $section->id;
                $menuItems[] = $data;
            }
        }

        Menu::insert($menuItems);
    }
}
