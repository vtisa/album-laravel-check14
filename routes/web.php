<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\FotoController;


Route::get('/', function () {
    return view('bienvenida');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('album', AlbumController::class);
Route::resource('foto', FotoController::class)->except(['index']);


Route::get('/album', [AlbumController::class, 'index'])->name('album.index');
Route::get('/album/create', [AlbumController::class, 'create'])->name('album.create');
Route::post('/album/store', [AlbumController::class, 'store'])->name('album.store');
Route::get('/album/{album}/edit', [AlbumController::class, 'edit'])->name('album.edit');
Route::put('/album/{album}/update', [AlbumController::class, 'update'])->name('album.update');
Route::delete('/album/destroy', [AlbumController::class, 'destroy'])->name('album.destroy');

//fotos
Route::resource('foto', FotoController::class);
Route::get('/foto', [FotoController::class, 'index'])->name('foto.index');
Route::post('/foto/store', [FotoController::class, 'store'])->name('foto.store');

Route::get('/foto/{foto}/edit', [FotoController::class, 'edit'])->name('foto.edit');

Route::put('/foto/{foto}/update', [FotoController::class, 'update'])->name('foto.update');

Route::delete('/foto/{id}', 'FotoController@destroy')->name('foto.destroy');