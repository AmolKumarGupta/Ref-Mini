<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create()
    {
        return view('session.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'agreement' => ['accepted'],
        ]);
        $attributes['password'] = bcrypt($attributes['password']);

        session()->flash('success', 'Your account has been created.');
        $user = User::create($attributes);
        Auth::login($user);

        return redirect('/dashboard');
    }
}
