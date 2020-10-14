<?php

namespace Samsin33\Razorpay\Services;

class SettlementApi extends RazorpayApi
{
    public function getSettlements()
    {
        return $this->api->settlement->all();
    }

    public function getSettlement($id)
    {
        return $this->api->settlement->fetch($id);
    }

    public function getSettlementReports($array)
    {
        return $this->api->settlement->reports($array);
    }


}