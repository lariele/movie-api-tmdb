<?php

use Illuminate\Support\Facades\Route;
use Lariele\Movie\Pages\Movies;


Route::group(['middleware' => 'web'], function() {
    Route::get('/movies', Movies::class)->name('movies');
});

#Route::get('/order/{order}-{orderSlug}', OrderDetail::class)->name('order');
