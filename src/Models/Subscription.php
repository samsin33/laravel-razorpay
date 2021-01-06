<?php

namespace Samsin33\Razorpay\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['plan_id', 'razorpay_subscription_id', 'razorpay_plan_id', 'total_count', 'customer_notify', 'quantity', 'start_at',
        'expired_by', 'request', 'response'];
    protected $visible = ['id', 'plan_id', 'razorpay_subscription_id', 'razorpay_plan_id', 'total_count', 'customer_notify', 'quantity', 'start_at',
        'expired_by', 'request', 'response', 'ipaddress', 'created_at', 'updated_at'];
}