<?php

namespace App\Http\Controllers;

use App\Models\MenuSection;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index() {
        return view('menu.index');
    }
}
