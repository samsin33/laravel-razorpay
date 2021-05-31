<?php

use Illuminate\Support\Facades\Route;

Route::post('payment-webhooks', 'WebhookController@handleWebhook')->name('webhook');
