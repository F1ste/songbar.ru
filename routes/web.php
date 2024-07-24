<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\SearchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('template');;
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');

    Route::get('/home', function(){
        return Redirect::to('/admin_panel');
    });


Route::middleware(['role:admin'])->prefix('admin_panel')->group(function () {

    Route::get('/payment/success', [App\Http\Controllers\Admin\PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/fail', [App\Http\Controllers\Admin\PaymentController::class, 'fail'])->name('payment.fail');
    Route::get('/payment/{order_id}', [App\Http\Controllers\Admin\PaymentController::class, 'pay'])->name('payment');
    Route::post('/order/create', [App\Http\Controllers\Admin\OrderController::class, 'create'])->name('order.create');
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin_panel');
    Route::get('/catalog', [App\Http\Controllers\Admin\CatalogController::class, 'index'])->name('catalog');
    Route::get('/catalog/create', [App\Http\Controllers\Admin\CatalogController::class, 'create'])->name('catalog.create');
    Route::get('/catalog/edit/{id}', [App\Http\Controllers\Admin\CatalogController::class, 'edit'])->name('catalog.edit');
    Route::post('/catalog/destroy/{id}', [App\Http\Controllers\CatalogController::class, 'destroy'])->name('catalog.destroy');
    Route::post('/catalog/infoupdate/{id}', [App\Http\Controllers\CatalogController::class, 'infoupdate'])->name('catalog.infoupdate');
    Route::get('/tarif', [App\Http\Controllers\Admin\TarifController::class, 'index'])->name('tarif');
    Route::post('/updateField', [App\Http\Controllers\Admin\CatalogController::class, 'updateField']);
    Route::post('/importExcell', [App\Http\Controllers\Admin\CatalogController::class, 'importExcell'])->name('importExcell');
    Route::post('/infoupdate', [App\Http\Controllers\Admin\CatalogController::class, 'infoupdate'])->name('infoupdate');
    Route::get('/processing-status', [App\Http\Controllers\Admin\CatalogController::class, 'getStatus'])->name('processing.status');
 });

 Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return 'Cache cleared';
});
