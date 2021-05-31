<?php

namespace Samsin33\Razorpay\Models;

use Illuminate\Database\Eloquent\Model;
use Samsin33\Razorpay\Services\SubscriptionApi;

class RzpSubscription extends Model
{
    protected $fillable = ['plan_id', 'rzp_subscription_id', 'rzp_plan_id', 'total_count', 'customer_notify', 'quantity', 'start_at',
        'expired_by', 'request', 'response'];
    protected $visible = ['id', 'plan_id', 'rzp_subscription_id', 'rzp_plan_id', 'total_count', 'customer_notify', 'quantity', 'start_at',
        'expired_by', 'request', 'response', 'ipaddress', 'razorpay_subscription', 'plan', 'created_at', 'updated_at'];

    protected $appends = ['razorpay_subscription'];

    private $save_request = true;
    private $save_response = true;

    public function setSaveRequest($bool)
    {
        $this->save_request = $bool;
    }

    public function setSaveResponse($bool)
    {
        $this->save_response = $bool;
    }

    //-------------------- Accessor --------------------------
    public function getRazorpaySubscriptionAttribute()
    {
        return $this->getRazorpaySubscription();
    }

    //-------------------- Relationships ---------------------
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function apiRequest()
    {
        return [
            'plan_id' => $this->plan->rzp_plan_id,
            'total_count' => $this->period,
            'quantity' => $this->interval,
            'customer_notify' => $this->customer_notify,
            'start_at' => $this->start_at,
            'expire_by' => $this->expire_by,
        ];
    }

    public function saveSubscription($add_request = [])
    {
        $subscription_api = new SubscriptionApi();
        $subscription_response = $subscription_api->createSubscription(array_merge($this->apiRequest(), $add_request));
        if ($this->save_request) {
            $this->request = json_encode(array_merge($this->apiRequest(), $add_request));
        }
        if ($this->save_response) {
            $this->response = $subscription_response;
        }
        $this->rzp_subscription_id = $subscription_response->subscription_id;
        $this->save();
        return $this;
    }

    public function saveAddon($addon)
    {
        $subscription_api = new SubscriptionApi();
        return $subscription_api->createAddon($this->rzp_subscription_id, $addon);
    }

    public function getRazorpaySubscription()
    {
        $subscription_api = new SubscriptionApi();
        return $subscription_api->getSubscription($this->rzp_subscription_id);
    }
}