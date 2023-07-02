<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class InfoUserController extends Controller
{
    public function create()
    {
        $user = Auth::user();

        return view('laravel-examples/user-profile', compact('user'));
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            'phone'     => ['max:50'],
            'location' => ['max:70'],
            'about_me'    => ['max:150'],
            'github_username' => ['string'],
            'gists_token' => [''],
        ]);
        if ($request->get('email') != Auth::user()->email) {
            if (env('IS_DEMO') && Auth::user()->id == 1) {
                return redirect()->back()->withErrors(['msg2' => 'You are in a demo version, you can\'t change the email address.']);
            }
        } else {
            $attribute = request()->validate([
                'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            ]);
        }

        $user = auth()->user();
        $user->fill([
            'name'    => $attributes['name'],
            'email' => $attributes['email'],
            'phone'     => $attributes['phone'],
            'location' => $attributes['location'],
            'about_me'    => $attributes['about_me'],
            'github_username' => $attributes['github_username'],
            'gists_token' => $attributes['gists_token'],
        ]);
        $properties = $user->logProp();
        $user->save();
        activity()->on($user)->withProperties($properties)->log(':subject.name updated the profile');

        return redirect('/user-profile')->with('success', 'Profile updated successfully');
    }
}
