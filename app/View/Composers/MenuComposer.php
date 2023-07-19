<?php

namespace App\View\Composers;

use App\Models\Menu;
use App\Models\MenuSection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

class MenuComposer
{
    public function compose(View $view): void
    {
        /**
         * @var array<array-key,Menu> $hash
         */
        $hash = [];

        /**
         * @var Collection<MenuSection> $sections
         */
        $sections = MenuSection::with('menu')->orderBy('order', 'ASC')->get();

        foreach ($sections as $s) {
            $hash[$s->name] = $s->menu;
        }
        $view->with('menugrp', $hash);
    }
}
