<?php

namespace Samsin33\Razorpay\Traits;

use Samsin33\Razorpay\Models\RzpOrderPayment;

trait ManageOrderPayment
{
    public function rzpOrderPayments()
    {
        return $this->hasMany(RzpOrderPayment::class, 'order_id', 'id');
    }
}