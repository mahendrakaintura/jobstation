<?php

use App\Http\Controllers\Project\ProjectController; 
use App\Http\Controllers\Entry\EntryController;
use App\Http\Controllers\User\UserFavoriteController;
use App\Http\Controllers\User\UserEntryController;
use App\Http\Controllers\Skillsheet\SkillsheetController;
use Illuminate\Support\Facades\Route;

Route::get('/entry/{project}/start', [EntryController::class, 'start'])
    ->name('entry.start');
Route::get('/entry/{project}/register', [EntryController::class, 'startRegister'])
    ->name('entry.start.register');

Route::middleware('auth')->group(function () {
    Route::prefix('entry')->name('entry.')->group(function () {
        Route::post('/', [EntryController::class, 'entry']);
        Route::get('/skillsheet', [EntryController::class, 'showSkillsheet'])->name('skillsheet');
        Route::post('/temporary-save', [EntryController::class, 'temporarySave'])->name('temporary-save');
        Route::post('/submit', [EntryController::class, 'submit'])->name('submit');
        Route::get('/back-to-project', [EntryController::class, 'backToProject'])->name('back-to-project');
        Route::get('/complete', [EntryController::class, 'complete'])->name('complete');
    });

    Route::prefix('skillsheet')->name('skillsheet.')->group(function () {
        Route::get('/', [SkillsheetController::class, 'show'])->name('show');
        Route::post('/', [SkillsheetController::class, 'store'])->name('store');
        Route::post('/work-experience', [SkillsheetController::class, 'storeWorkExperience'])
            ->name('work-experience.store');
        Route::delete('/work-experience/{experience}', [SkillsheetController::class, 'destroyWorkExperience'])
            ->name('work-experience.destroy');
    });

    Route::prefix('mypage')->name('mypage.')->group(function () {
        Route::prefix('entries')->name('entries.')->group(function () {
            Route::get('/', [UserEntryController::class, 'index']);
            Route::patch('/cancel', [UserEntryController::class, 'cancel'])->name('cancel');
        });
        Route::prefix('favorites')->name('favorites.')->group(function () {
            Route::get('/', [UserFavoriteController::class, 'index']);
            Route::delete('/destroy', [UserFavoriteController::class, 'destroy'])->name('destroy');
        });
    });
});

Route::get('/', [ProjectController::class, 'index'])->name('home');
Route::resource('projects', ProjectController::class)->only(['index', 'show']);

require __DIR__.'/auth.php';