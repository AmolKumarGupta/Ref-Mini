<?php

namespace App\View\Composers;

use App\Models\Menu;
use App\Models\MenuSection;
use Illuminate\View\View;

class MenuComposer
{
    public function getMenu($section_id)
    {
        $menus = Menu::where('fk_section_id', $section_id)->orderBy('order', 'ASC')->get();
        $res = [];

        foreach ($menus as $m) {
            $res[] = [
                'name' => $m->name,
                'url' => $m->url,
                'icon' => $m->icon,
            ];
        }

        return $res;
    }

    public function compose(View $view): void
    {
        $hash = [];
        $sections = MenuSection::orderBy('order', 'ASC')->get();

        foreach ($sections as $s) {
            $hash[$s->name] = $this->getMenu($s->id);
        }
        $view->with('menugrp', $hash);
    }
}
