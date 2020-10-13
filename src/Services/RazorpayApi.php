<?php

namespace Samsin33\Razorpay\Services;

use Razorpay\Api\Api;

abstract class RazorpayApi
{
    protected $api;

    public function __construct()
    {
        $this->api = new Api(config('razorpay.key'), config('razorpay.secret'));
    }
}