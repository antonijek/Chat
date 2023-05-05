<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConnectionController;


Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::middleware([\App\Http\Middleware\IsUser::class])->group(function () {
        Route::get('/connections', [ConnectionController::class, 'index'])->name('connection.index');
        Route::get('/connection/{user}', [ConnectionController::class, 'create'])->name('connection.create');
        Route::post('/connection', [ConnectionController::class, 'store'])->name('connection.store');
        Route::get('/connections/{connection}/edit', [ConnectionController::class, 'edit'])->name('connection.edit');
        Route::get('/connection/message/{friendId}', [ConnectionController::class, 'message'])->name('connection.message');
        Route::put('/connection/{connection}', [ConnectionController::class, 'update'])->name('connection.update');
        Route::put('/connections/{connection}/message', [ConnectionController::class, 'updateMessage'])->name('connection.updateMessage');
    });

    Route::middleware([\App\Http\Middleware\IsAdmin::class])->group(function () {
        Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
        Route::get('register', [UserController::class, 'create'])->name('user.register');
        Route::post('register', [UserController::class, 'store']);
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('user.update');
    });

    Route::get('/my-profile', [UserController::class, 'showUsersWithoutMyself'])->name('my-profile');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


require __DIR__.'/auth.php';
