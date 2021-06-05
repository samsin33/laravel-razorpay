<?php

use Illuminate\Support\Facades\Route;
use Samsin33\Razorpay\Http\Controllers\WebhooksController;

Route::post('payment-webhooks', [WebhooksController::class, 'handleWebhook'])->name('payment-webhooks');
Route::post('order-webhooks', [WebhooksController::class, 'handleOrderWebhook'])->name('order-webhooks');
