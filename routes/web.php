<?php

use App\Http\Controllers\Project\ProjectController; 
use App\Http\Controllers\Entry\EntryController;
use App\Http\Controllers\User\UserEntryController;
use App\Http\Controllers\Skillsheet\SkillsheetController;
use App\Http\Controllers\User\UserSkillSheetController;
use Illuminate\Support\Facades\Route;

Route::get('/entry/{project}/start', [EntryController::class, 'start'])
    ->name('entry.start');
Route::get('/entry/{project}/register', [EntryController::class, 'startRegister'])
    ->name('entry.start.register');

Route::middleware('auth')->group(function () {
    Route::prefix('entry')->name('entry.')->group(function () {
        Route::get('/skillsheet', [EntryController::class, 'showSkillsheet'])->name('skillsheet');
        Route::post('/temporary-save', [EntryController::class, 'temporarySave'])->name('temporary-save');
        Route::post('/submit', [EntryController::class, 'submit'])->name('submit');
        Route::get('/back-to-project', [EntryController::class, 'backToProject'])->name('back-to-project');
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
            Route::get('/', [UserEntryController::class, 'index'])->name('index');
            Route::patch('/cancel', [UserEntryController::class, 'cancel'])->name('cancel');
        });
        Route::prefix('skillsheet')->name('skillsheet.')->group(function () {
            Route::get('/edit', [UserSkillSheetController::class, 'edit'])->name('edit');
            Route::post('/update', [UserSkillSheetController::class, 'update'])->name('update');
        });
    });
});

Route::get('/', [ProjectController::class, 'index'])->name('home');
Route::resource('projects', ProjectController::class)->only(['index', 'show']);

require __DIR__.'/auth.php';