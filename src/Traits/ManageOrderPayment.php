<?php

namespace Samsin33\Razorpay\Traits;

use Samsin33\Razorpay\Models\RzpOrderPayments;

trait ManageOrderPayment
{
    public function rzpOrderPayment()
    {
        return $this->hasMany(RzpOrderPayments::class, 'order_id', 'id');
    }
}