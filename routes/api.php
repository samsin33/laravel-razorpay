<?php

use Illuminate\Support\Facades\Route;
use Samsin33\Razorpay\Http\Controllers\PlansController;
use Samsin33\Razorpay\Http\Controllers\SubscriptionsController;

Route::post('plans', [PlansController::class, 'store'])->name('plans.store');
Route::get('plans/{id}', [PlansController::class, 'show'])->name('plans.show');

Route::post('subscriptions', [SubscriptionsController::class, 'store'])->name('subscriptions.store');
Route::get('subscriptions/{id}', [SubscriptionsController::class, 'show'])->name('subscriptions.show');
