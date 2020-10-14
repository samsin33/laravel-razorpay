<?php

namespace Samsin33\Razorpay\Services;

class CustomerApi extends RazorpayApi
{
    public function createCustomer($array)
    {
        return $this->api->customer->create($array);
    }

    public function editCustomer($id, $array)
    {
        $this->api->customer->id = $id;
        return $this->api->customer->edit($array);
    }

    public function getCustomer($id)
    {
        return $this->api->customer->fetch($id);
    }

    public function getToken($id)
    {
        return $this->api->customer->token()->fetch($id);
    }

    public function getTokens($options)
    {
        return $this->api->customer->token()->all($options);
    }

    public function deleteToken($id)
    {
        return $this->api->customer->token()->delete($id);
    }
}