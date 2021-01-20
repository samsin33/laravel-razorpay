<?php

namespace Samsin33\Razorpay\Models;

use Illuminate\Database\Eloquent\Model;
use Samsin33\Razorpay\Services\SubscriptionApi;

class Plan extends Model
{
    protected $fillable = ['razorpay_plan_id', 'name', 'amount', 'currency', 'period', 'interval', 'entity', 'description', 'request', 'response'];
    protected $visible = ['id', 'razorpay_plan_id', 'name', 'amount', 'currency', 'period', 'interval', 'entity', 'description',
        'request', 'response', 'ipaddress', 'created_by', 'updated_at', 'razorpay_plan', 'subscriptions'];

    protected $appends = ['razorpay_plan'];

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
    public function getRazorpayPlanAttribute()
    {
        return $this->getRazorpayPlan();
    }

    //-------------------- Relationships ---------------------
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function apiRequest()
    {
        return [
            'period' => $this->period,
            'interval' => $this->interval,
            'item' => [
                'name' => $this->name,
                'amount' => $this->amount,
                'currency' => isset($this->currency) && !empty($this->currency) ? $this->currency : config('razorpay.currency'),
                'description' => $this->description,
            ],
        ];
    }

    public function savePlan($add_request = [])
    {
        $plan_api = new SubscriptionApi();
        $plan_response = $plan_api->createPlan(array_merge($this->apiRequest(), $add_request));
        if ($this->save_request) {
            $this->request = json_encode(array_merge($this->apiRequest(), $add_request));
        }
        if ($this->save_response) {
            $this->response = $plan_response;
        }
        $this->entity = $plan_response->entity;
        $this->razorpay_plan_id = $plan_response->plan_id;
        $this->save();
        return $this;
    }

    public function getRazorpayPlan()
    {
        $subscription_api = new SubscriptionApi();
        return $subscription_api->getSubscription($this->razorpay_plan_id);
    }
}
