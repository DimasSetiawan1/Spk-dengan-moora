<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubkriteriaController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    if (auth()) {
        return redirect()->route('dashboard');
    }
    return view('login');
})->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/download', [PDFController::class, 'generatePDF'])->name('generate_pdf');
    Route::resources([
        'perhitungan' => PerhitunganController::class,
        'supplier' => SupplierController::class,
        'profile' => ProfileController::class,
        'subkriteria' => SubkriteriaController::class,

    ]);



    Route::middleware('can:admin')->group(function () {
        Route::resources([
            'kriteria' => KriteriaController::class,
            'penilaian' => PenilaianController::class,
        ]);
    });

    Route::middleware('can:superadmin')->group(function () {
        Route::resources([
            'lists/users' => UsersController::class,
            'penilaian' => PenilaianController::class,

        ]);
        Route::delete('/lists/supplier/clear', [SupplierController::class, 'clearDataSupplier'])->name('supplier.clear');
    });
});



/**
 * Define a fallback route for handling 404 errors.
 *
 * This route is triggered when no other routes match the current request.
 * It returns a view for a custom 404 error page.
 *
 * @return \Illuminate\View\View The 404 error page view
 */
Route::fallback(function () {
    return view('pages.error.404');
});
