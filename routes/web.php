<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\SearchController;
use App\Http\Controllers\Admin\CatalogController;
use App\Http\Controllers\Admin\SongController;

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
        return Redirect::to('/admin_panel/catalogs');
    });


Route::middleware(['auth'])->prefix('admin_panel')->group(function () {
    Route::get('/payment/fail', [App\Http\Controllers\Admin\PaymentController::class, 'fail'])->name('payment.fail');
    Route::get('/payment/{order_id}', [App\Http\Controllers\Admin\PaymentController::class, 'pay'])->name('payment');
    Route::post('/order/create', [App\Http\Controllers\Admin\OrderController::class, 'create'])->name('order.create');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('admin_panel');
    Route::get('/catalog/preview', [CatalogController::class, 'preview'])->name('catalog.preview');
    Route::get('/catalogs', [CatalogController::class, 'index'])->name('catalogs');
    Route::get('/catalog/create', [CatalogController::class, 'create'])->name('catalog.create');
    Route::get('/catalog/edit/{id}', [CatalogController::class, 'edit'])->name('catalog.edit');
    Route::post('/catalog/destroy/{id}', [CatalogController::class, 'destroy'])->name('catalog.destroy');
    Route::post('/catalog/infoupdate/{id}', [CatalogController::class, 'infoupdate'])->name('catalog.infoupdate');
    Route::get('/tarif', [CatalogController::class, 'index'])->name('tarif');
    Route::post('/updateField', [CatalogController::class, 'updateField']);
    Route::post('/importExcell', [CatalogController::class, 'importExcell'])->name('importExcell');
    Route::post('/infoupdate', [CatalogController::class, 'infoupdate'])->name('infoupdate');
    Route::get('/get-processing-status', [CatalogController::class, 'checkProgress'])->name('processing.status');
    Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    Route::get('/help-center', [App\Http\Controllers\Admin\HelpCenterController::class, 'index'])->name('help');
    Route::get('/songs/fetch', [CatalogController::class, 'fetchSongs'])->name('songs.fetch');
    Route::post('/catalog/songs', [SongController::class, 'store'])->name('songs.store');
    Route::delete('/catalog/songs/{song}', [SongController::class, 'destroy'])->name('songs.destroy');
    Route::get('/song-search', [CatalogController::class, 'fetchSongs'])->name('songs.search');
});

 Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return 'Cache cleared';
});
