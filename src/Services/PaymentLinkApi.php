<?php

namespace Samsin33\Razorpay\Services;

class PaymentLinkApi extends RazorpayApi
{
    public function createPaymentLink($array, $notify = true, $notify_by = 'sms')
    {
        $link = $this->api->invoice->create($array);
        if ($notify) {
            $link->notifyBy($notify_by);
        }
        return $link;
    }

    public function getPaymentLink($invoice_id)
    {
        return $this->api->invoice->fetch($invoice_id);
    }

    public function getPaymentLinks()
    {
        return $this->api->invoice->all();
    }

    public function cancelPaymentLink($invoice_id)
    {
        return $this->getPaymentLink($invoice_id)->cancel();
    }

    public function sendNotification($invoice_id, $notify_by = 'sms')
    {
        return $this->getPaymentLink($invoice_id)->notifyBy($notify_by);
    }
}