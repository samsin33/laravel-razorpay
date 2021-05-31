<?php

namespace Samsin33\Razorpay\Http\Controllers;

use Exception;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Samsin33\Razorpay\Models\RzpOrderPayments;

class WebhooksController extends Controller
{
    public function handleWebhook(Request $request)
    {
        if (empty($request->payload->payment->entity->id)) {
            throw new Exception('Invalid Data.', 400);
        }
        $pay_id = $request->payload->payment->entity->id;
        $signature = $request->header('x-razorpay-signature');
        $ord_id = $request->payload->payment->entity->order_id ?? '';
        $model = config('razorpay.order_model');
        $ord = $model::where('rzp_order_id', $ord_id)->where('rzp_payment_id', $pay_id)->firstOrFail();
        $ord_payment = $ord->rzpOrderPayment()->first();
        $webhook = [
            'rzp_payment_id' => $pay_id,
            'rzp_signature' => $signature,
            'status' => $request->payload->payment->entity->status,
            'data' => json_encode($request->all()),
        ];
        if (!empty($ord_payment)) {
            $ord_payment = new RzpOrderPayments($webhook);
            $ord->rzpOrderPayment()->save($ord_payment);
        } else {
            $ord_payment->update($webhook);
        }
        return true;
    }
}