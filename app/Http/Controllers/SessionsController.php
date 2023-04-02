<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);

        if (Auth::attempt($attributes)) {
            session()->regenerate();

            activity(config('log.login'))->on(auth()->user())
                ->withProperties([
                    'at' => Carbon::now()->toFormattedDateString(),
                    'ip_address' => request()->ip(),
                ])->log(':subject.name logged in on :properties.at');

            return redirect('dashboard')->with(['success'=>'You are logged in.']);
        } else {
            return back()->withErrors(['email'=>'Email or password invalid.']);
        }
    }

    public function destroy()
    {
        activity(config('log.logout'))->on(auth()->user())
            ->withProperties([
                'at' => Carbon::now()->toFormattedDateString(),
                'ip_address' => request()->ip(),
            ])->log(':subject.name logged out on :properties.at');

        Auth::logout();
        Cache::flush();

        return redirect('/login')->with(['success'=>'You\'ve been logged out.']);
    }
}
