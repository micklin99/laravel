<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClubController;

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

Route::get('/', function () {
    return view('welcome');
});

// Test Dashboard
Route::get('/test-dashboard', function () {
    return view('test/test-dashboard');
})->middleware(['auth'])->name('test-dashboard');

///////////////////////////////////
//                               //
//        Forty Goals            //
//                               //
///////////////////////////////////

//
// Dashboard Page
//
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


//
// Clubs
//

// ## Club View ##
Route::get('/clubs', [ClubController::class, 'index'])->middleware(['auth'])->name('clubs.index');

Route::get('/clubs/view/{id}', [ClubController::class, 'view'])->middleware(['auth'])->name('clubs.view');

// ## Club Create
Route::get('/clubs/create', [ClubController::class, 'create'])->middleware(['auth'])->name('clubs.create');
Route::post('/clubs/store', [ClubController::class, 'store'])->middleware(['auth'])->name('clubs.store');

// ## Club Update
Route::get('/clubs/edit/{id}', [ClubController::class, 'edit'])->middleware(['auth'])->name('clubs.edit');
Route::post('/clubs/update/{id}', [ClubController::class, 'update'])->middleware(['auth'])->name('clubs.update');

// ## Club Enable
Route::get('/clubs/enable/{id}', [ClubController::class, 'enable'])->middleware(['auth'])->name('clubs.enable');

// ## Club Disable
Route::get('/clubs/disable/{id}', [ClubController::class, 'disable'])->middleware(['auth'])->name('clubs.disable');


require __DIR__.'/auth.php';
