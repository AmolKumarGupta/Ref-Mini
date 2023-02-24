<?php

namespace App\Http\Controllers;

use App\Models\MenuSection;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index() {
        $menuSection = MenuSection::orderBy('order', 'ASC')->get();

        return view('menu.index', compact( 'menuSection' ));
    }
}
