<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function index() {
        return view('menu.index');
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json( $validator->errors() , 400);
        }

        try {
            $section = new MenuSection;
            $section->name = $request->name;
            $section->save();
            
            return response()->json($request->name);

        }catch (\Exception $e) {
            return response()->json("Something went wrong", 500);
        }
    }

    public function createItem(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' =>'required',
            'url' =>'required',
            'icon' =>'required'
        ]);

        if ($validator->fails()) {
            return response()->json( $validator->errors(), 400);
        }

        try {
            $item = new Menu;
            $item->fk_section_id = $request->section_id;
            $item->name = $request->name;
            $item->url = $request->url;
            $item->icon = 'fa-'.$request->icon;
            $item->save();

            return response()->json($request->name);

        }catch (\Exception $e) {
            return response()->json("Something went wrong", 500);
        }
    }
}
