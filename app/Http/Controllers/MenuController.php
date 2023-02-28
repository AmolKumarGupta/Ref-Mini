<?php

namespace App\Http\Controllers;

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
}
