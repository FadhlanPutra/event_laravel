<?php

use App\Http\Controllers\eventController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

route::get('/dashboard', [eventController::class, 'index2', 'search2'])->middleware(['auth', 'verified'])->name('dashboard');
// route::get('/dashboard', [eventController::class, 'index']);
route::resource('/event', eventController::class)->names(['index' => 'event']);
Route::get('/event/search', [eventController::class, 'index', 'search'])->name('search.event');

Route::get('/dashboard/search', [eventController::class, 'index2', 'search2'])->name('search.dashboard');
Route::put('/event/{id}', [eventController::class, 'update'])->name('event.update');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
