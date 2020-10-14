<?php

namespace Samsin33\Razorpay\Services;

class SubscriptionApi extends RazorpayApi
{
    public function createPlan($array)
    {
        return $this->api->plan->create($array);
    }

    public function getPlan($plan_id)
    {
        return $this->api->plan->fetch($plan_id);
    }

    public function getPlans()
    {
        return $this->api->plan->all();
    }

    public function createSubscription($array)
    {
        return $this->api->subscription->create($array);
    }

    public function getSubscription($subscription_id)
    {
        return $this->api->subscription->fetch($subscription_id);
    }

    public function getSubscriptions()
    {
        return $this->api->subscription->all();
    }

    public function createAddon($subscription_id, $array)
    {
        return $this->api->subscription->fetch($subscription_id)->createAddon($array);
    }

    public function getAddon($addon_id)
    {
        return $this->api->addon->fetch($addon_id);
    }

    public function deleteAddon($addon_id)
    {
        return $this->api->addon->fetch($addon_id)->delete();
    }
}