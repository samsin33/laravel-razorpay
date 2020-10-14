<?php

namespace Samsin33\Razorpay\Services;

class RouteApi extends RazorpayApi
{
    public function createTransfer($payment_id, $array)
    {
        return $this->api->payment->fetch($payment_id)->transfer($array);
    }

    public function getTransfer($transfer_id)
    {
        return $this->api->transfer->fetch($transfer_id);
    }

    public function editTransfer($transfer_id, $options)
    {
        return $this->getTransfer($transfer_id)->edit($options);
    }

    public function getPaymentTransfers($payment_id)
    {
        return $this->api->payment->fetch($payment_id)->transfers();
    }

    public function getTransfers()
    {
        return $this->api->transfer->all();
    }

    public function reverseTransfer($transfer_id)
    {
        return $this->getTransfer($transfer_id)->reverse();
    }
}
