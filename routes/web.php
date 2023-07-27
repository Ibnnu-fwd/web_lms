<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('/');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('product', fn () => view('product'))->name('product');
Route::get('product/{id}', fn ($id) => view('detail-product', ['id' => $id]))->name('detail-product');
Route::get('about', fn () => view('about'))->name('about');
Route::get('order-flow', fn () => view('order-flow'))->name('order-flow');

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'isActiveUser']], function () {
    Route::get('/', fn () => view('admin.dashboard'));
});

require __DIR__ . '/auth.php';
