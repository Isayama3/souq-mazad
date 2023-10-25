<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\AdminController;
use App\Http\Controllers\Api\Client\ClientController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ============= Client Routes ==============
Route::group(['prefix' => 'client'], function () {
    Route::post('login', [ClientController::class, 'login'])->name('client.login');
    Route::post('register', [ClientController::class, 'store'])->name('client.register');
    
    Route::namespace('App\Http\Controllers\Api\Client')->middleware(['auth:client-api'])->name('client.')->group(function () {
        Route::resource('clients', 'ClientController')->only(['index', 'show']);
        Route::resource('cart', 'CartController')->only(['index', 'show']);
        Route::post('add-to-cart', 'CartController@addToCart')->name('add-to-cart');
        Route::resource('products', 'ProductController')->only(['index', 'show']);
        Route::resource('categories', 'CategoryController')->only(['index', 'show']);
        Route::resource('shipping-addresses', 'ShippingAddressController')->except(['delete']);
        Route::resource('banners', 'BannerController')->only(['index', 'show']);
    });
});

// ============= User Routes ==============
Route::group(['prefix' => 'admin'], function () {
    Route::post('login', [AdminController::class, 'login'])->name('admin.login');
    
    Route::namespace('App\Http\Controllers\Api\Admin')->middleware(['auth:admin-api'])->name('admin.')->group(function () {
        Route::resource('clients', 'ClientController');
        Route::get('block-client/{id}', 'ClientController@blockClient')->name('block.client');
        Route::resource('admins', 'AdminController');
        Route::resource('products', 'ProductController');
        Route::resource('categories', 'CategoryController');
        Route::resource('shipping-addresses', 'ShippingAddressController');
        Route::resource('carts', 'CartController')->only(['index', 'show']);
        Route::resource('banners', 'BannerController');
    });
});
