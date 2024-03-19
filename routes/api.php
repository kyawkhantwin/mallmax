<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeApi;


Route::group(["namespace" => "Api"],function (){
    Route::get('/home','HomeApi@index');
    Route::get('/product/{slug}','HomeApi@detail');
    Route::get('/product/search/{name}','HomeApi@search');
    Route::post('/make-review/{slug}','ReviewApi@makeReview');
    Route::post('/product/cart/{slug}','CartApi@postCart');
    Route::get('/product/cart/{slug}','CartApi@getCart');
    Route::delete('/product/cart/{slug}','CartApi@deleteCart');
    Route::delete('/product/carts/delete/{id}','CartApi@deleteAllCart');

    Route::get('/transaction', 'TransactionApi@index'); // Read all transactions
    Route::get('/transaction/{orderId}', 'TransactionApi@show'); // Read a specific transaction
    Route::post('/transaction', 'TransactionApi@store'); // Create a new transaction
});

