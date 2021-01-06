<?php

namespace Samsin33\Razorpay\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['razorpay_plan_id', 'entity', 'period', 'interval', 'request', 'response'];
    protected $visible = ['id', 'razorpay_plan_id', 'entity', 'period', 'interval', 'request', 'response', 'ipaddress', 'created_by', 'updated_at'];
}