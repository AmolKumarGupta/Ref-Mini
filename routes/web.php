<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\HabitTrackerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'home']);
    // Route::get('dashboard', function () {
    // 	return view('dashboard');
    // })->name('dashboard');

    Route::get('billing', function () {
        return view('billing');
    })->name('billing');

    // Route::get('profile', function () {
    // 	return view('profile');
    // })->name('profile');

    Route::get('rtl', function () {
        return view('rtl');
    })->name('rtl');

    Route::get('user-management', function () {
        return view('laravel-examples/user-management');
    })->name('user-management');

    Route::get('tables', function () {
        return view('tables');
    })->name('tables');

    Route::get('virtual-reality', function () {
        return view('virtual-reality');
    })->name('virtual-reality');

    Route::get('static-sign-in', function () {
        return view('static-sign-in');
    })->name('sign-in');

    Route::get('static-sign-up', function () {
        return view('static-sign-up');
    })->name('sign-up');

    Route::get('/logout', [SessionsController::class, 'destroy']);
    // Route::get('/user-profile', [InfoUserController::class, 'create']);
    // Route::post('/user-profile', [InfoUserController::class, 'store']);
    // Route::get('/login', function () {
    // 	return view('dashboard');
    // })->name('sign-up');
});

Route::group(['middleware' => 'auth'], function () {
    Route::prefix('menu')->group(function () {
        Route::get('/', [MenuController::class, 'index']);
        Route::post('/create', [MenuController::class, 'create'])->name('menu.section.create');
        Route::post('/create-item', [MenuController::class, 'createItem'])->name('menu.item.create');
    });

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashBoardController::class, 'index'])->name('dashboard');
    });

    Route::prefix('portfolio')->group(function () {
        Route::get('/repos', function () {
            return view('portfolio.repos');
        });
    });

    Route::get('/user-profile', [InfoUserController::class, 'create']);
    Route::post('/user-profile', [InfoUserController::class, 'store']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::prefix('habit-tracker')->group(function () {
        Route::get('/', [HabitTrackerController::class, 'index']);
        Route::get('/ajax', [HabitTrackerController::class, 'ajax'])->name('habit-tracker.ajax');
    });
});

/* Route::get('test', function () {
    (new \App\Library\GithubClient)->gists();
}); */

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    // Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
    Route::get('/login/forgot-password', [ResetController::class, 'create']);
    Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
    Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
    Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
    Route::get('/login', function () {
        return view('session/login-session');
    })->name('login');
});
