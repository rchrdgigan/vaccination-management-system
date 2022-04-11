<?php

use App\Http\Controllers\{ChildImportController, ChildrenController,VaccinesController,VaccinesExportController, VaccinesImportController};
use App\Models\Barangay;
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
Route::middleware('auth')->group(function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //children
    Route::controller(ChildrenController::class)
        ->as('children.')
        ->prefix('children')
        ->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{child}', 'edit')->name('edit');
            Route::put('/update/{child}', 'update')->name('update');
        });
    //vaccines
    Route::controller(VaccinesController::class)
        ->as('vaccines.')
        ->prefix('vaccines')
        ->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{vaccine}', 'edit')->name('edit');
            Route::put('/update/{vaccine}', 'update')->name('update');
        });

    Route::post('/vaccines/import', [VaccinesImportController::class, 'store'])->name('vaccines.import');
    Route::post('/child/import', [ChildImportController::class, 'store'])->name('child.import');
});
Auth::routes();

Route::get('/register', function(){
    $barangays = Barangay::get();
    return view('auth.register', compact('barangays'));
})->name('register');
