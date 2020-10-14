<?php

namespace Samsin33\Razorpay\Services;

class InvoiceApi extends RazorpayApi
{
    public function createInvoice($params)
    {
        return $this->api->invoice->create($params);
    }

    public function getInvoice($invoice_id)
    {
        return $this->api->invoice->fetch($invoice_id);
    }

    public function editInvoice($invoice_id, $params)
    {
        return $this->getInvoice($invoice_id)->edit($params);
    }

    public function issueInvoice($invoice_id)
    {
        return $this->getInvoice($invoice_id)->issue();
    }

    public function getInvoices()
    {
        return $this->api->invoice->all();
    }

    public function cancelInvoice($invoice_id)
    {
        return $this->getInvoice($invoice_id)->cancel();
    }

    public function deleteInvoice($invoice_id)
    {
        return $this->getInvoice($invoice_id)->delete();
    }

    public function sendNotification($invoice_id, $notify_by = 'sms')
    {
        return $this->getInvoice($invoice_id)->notifyBy($notify_by);
    }
}