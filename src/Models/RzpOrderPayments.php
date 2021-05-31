<?php

namespace Samsin33\Razorpay\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class RzpOrderPayments extends Model
{
    protected $fillable = ['order_id', 'rzp_payment_id', 'rzp_signature', 'status', 'data', 'ipaddress'];
    protected $visible = ['id', 'order_id', 'rzp_payment_id', 'rzp_signature', 'status', 'data', 'ipaddress',
        'created_at', 'updated_at'];

    //--------------------- Relationships ------------------------------
    public function order(): BelongsTo
    {
        return $this->belongsTo(config('razorpay.order_model'), 'order_id', 'id');
    }
}