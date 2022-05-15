<?php

use App\Http\Controllers\{ChildVaccinesImportController,ChildImportController, ChildrenController,VaccinesController,VaccinesExportController, VaccinesImportController,ChildVaccinesController,GenerateReportController};
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
    //childvaccines
    Route::controller(ChildVaccinesController::class)
        ->as('child-vaccines.')
        ->prefix('child-vaccines')
        ->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{child_id}', 'edit')->name('edit');
            Route::put('/update/{childvaccines}', 'update')->name('update');
            Route::get('/remove/{childvaccines}', 'remove')->name('remove');
            Route::delete('/destroy', 'destroy')->name('destroy');
            Route::get('/show/{childvaccines}', 'show')->name('show');
            Route::get('/search', 'search')->name('search');
            Route::get('/available/vaccine/{child_id}', 'getChildVaccineAvailable')->name('available');
            Route::post('/inject', 'injectData')->name('inject');
        });
    Route::controller(ChildVaccinesController::class)
        ->as('generate-report.')
        ->prefix('generate-report')
        ->group(function(){
            Route::get('/report/view', 'viewReport')->name('view');
            Route::get('/report/view/child', 'viewReportChild')->name('viewchild');
        });
    
    Route::post('/vaccines/import', [VaccinesImportController::class, 'store'])->name('vaccines.import');
    Route::post('/child/import', [ChildImportController::class, 'store'])->name('child.import');
    Route::post('/child-vaccines/import', [ChildVaccinesImportController::class, 'store'])->name('child-vaccines.import');
});
Auth::routes();

Route::get('/register', function(){
    $barangays = Barangay::get();
    return view('auth.register', compact('barangays'));
})->name('register');
