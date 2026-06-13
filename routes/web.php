<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::redirect('/','blog/list');

Route::group(['prefix' => 'blog'], function(){

    Route::get('list',[BlogController::class,'list'])->name('blog#list');//create route for home page
    Route::post('create',[BlogController::class,'create'])->name('blog#create');//create route for taking data from form
    Route::get('delete/{id}', [BlogController::class, 'delete'])->name('blog#delete'); //create route for deleting items
    Route::get('edit/{id}', [BlogController::class, 'edit'])->name('blog#edit'); //create route for editing items
    Route::post('update/{id}', [BlogController::class, 'update'])->name('blog#update'); //create route for updating items
});
