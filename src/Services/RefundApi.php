<?php

namespace Samsin33\Razorpay\Services;

class RefundApi extends RazorpayApi
{
    public function createRefund($array)
    {
        return $this->api->refund->create($array);
    }

    public function getRefund($refund_id)
    {
        return $this->api->refund->fetch($refund_id);
    }
}