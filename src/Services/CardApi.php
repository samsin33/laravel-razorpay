<?php

namespace Samsin33\Razorpay\Services;

class CardApi extends RazorpayApi
{
    public function getCard($card_id)
    {
        return $this->api->card->fetch($card_id);
    }
}