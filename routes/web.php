<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Mood\MoodController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])-> name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/create', [MoodController::class, 'create'])->name('mood.create');
    Route::post('/mood/create', [MoodController::class, 'createRecord'])->name('mood.createRecord');
    Route::get('/mood/all', [MoodController::class, 'allRecords'])->name('mood.all');
    Route::get('/mood/search', [MoodController::class, 'searchByDate'])->name('mood.search');
    Route::get('/mood/{id}/edit', [MoodController::class, 'editRecord'])->name('mood.edit');
    Route::post('/mood/{id}/update', [MoodController::class, 'updateRecord'])->name('mood.update');
    Route::get('/trashes', [MoodController::class, 'trash'])->name('trash');
    Route::post('/mood/{id}/restore', [MoodController::class, 'restore'])->name('mood.restore');
    Route::delete('mood/delete/{id}', [MoodController::class, 'delete'])->name('mood.delete');
     Route::get('/mood/{id}/detail', [MoodController::class, 'moodDetails'])->name('mood.details');

});

require __DIR__.'/auth.php';
