<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::redirect('/','blog/list');

Route::group(['prefix' => 'blog'], function(){

    Route::get('list',[BlogController::class,'list'])->name('blog#list');
});
