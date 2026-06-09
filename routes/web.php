<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::redirect('/','blog/list');

Route::group(['prefix' => 'blog'], function(){

    Route::get('list',[BlogController::class,'list'])->name('blog#list');//create route for home page
    Route::post('create',[BlogController::class,'create'])->name('blog#create');//create route for taking data from form
});
