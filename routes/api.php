<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('users', '\App\Http\Controllers\UserController');
Route::apiResource('packages', '\App\Http\Controllers\PackageController');
Route::apiResource('delivery_services', '\App\Http\Controllers\DeliveryServiceController');

Route::post('deliveries/send-delivery-data', '\App\Http\Controllers\DeliveryController@sendDeliveryData');
Route::apiResource('deliveries', '\App\Http\Controllers\DeliveryController');




