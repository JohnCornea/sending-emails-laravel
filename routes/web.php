<?php

use App\Http\Controllers\ProfileController;
use App\Mail\UserTestEmail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mail', function () {

    $user = User::find(3);
    // $users = User::all();

    // foreach ($users as $user)
    // {
    //     Mail::to($user)->send(new UserTestEmail($user));
    // }
    
    Mail::to($user)->send(new UserTestEmail($user));

    return 'EMAIL SENT';
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
