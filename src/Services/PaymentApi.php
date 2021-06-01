<?php

namespace Samsin33\Razorpay\Services;

class PaymentApi extends RazorpayApi
{
    public function capturePayment($payment_id, $array)
    {
        return $this->api->payment->fetch($payment_id)->capture($array);
    }

    public function getPayment($payment_id)
    {
        return $this->api->payment->fetch($payment_id);
    }

    public function getPayments($array)
    {
        return $this->api->payment->all($array);
    }

    public function verifyWebhookSignature($webhook_body, $webhook_signature, $webhook_secret = null)
    {
        return $this->api->utility->verifyWebhookSignature($webhook_body, $webhook_signature, (!empty($webhook_secret) ? $webhook_secret : config('razorpay.webhook.secret')));
    }
}