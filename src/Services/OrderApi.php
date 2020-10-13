<?php

namespace Samsin33\Razorpay\Services;

class OrderApi extends RazorpayApi
{
    public function createOrder($array)
    {
        return $this->api->order->create($array);
    }

    public function getOrder($id)
    {
        return $this->api->order->fetch($id);
    }

    public function getOrders($options)
    {
        return $this->api->order->all($options);
    }

    public function getOrderPayments($id)
    {
        return $this->api->order->fetch($id)->payments();
    }
}