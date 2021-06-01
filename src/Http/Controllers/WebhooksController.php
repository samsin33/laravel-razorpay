<?php

namespace Samsin33\Razorpay\Http\Controllers;

use Exception;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Samsin33\Razorpay\Models\RzpOrderPayment;

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
        $ord = $model::where('rzp_order_id', $ord_id)->firstOrFail();
        $ord_payment = $ord->rzpOrderPayments()->where('rzp_payment_id', $pay_id)->first();
        $webhook = [
            'rzp_payment_id' => $pay_id,
            'rzp_signature' => $signature,
            'status' => $request->payload->payment->entity->status ?? '',
            'data' => json_encode($request->all()),
        ];
        if (!empty($ord_payment)) {
            $ord_payment = new RzpOrderPayment($webhook);
            $ord->rzpOrderPayments()->save($ord_payment);
        } else {
            if ($ord_payment->status != 'captured' && $ord_payment->status != 'failed') {
                $ord_payment->update($webhook);
            }
        }
        return response()->json(['success' => true]);
    }

    public function handleOrderWebhook(Request $request)
    {
        if (empty($request->payload->order->entity->id)) {
            throw new Exception('Invalid Data.', 400);
        }
        $ord_id = $request->payload->order->entity->id;
        $model = config('razorpay.order_model');
        $ord = $model::where('rzp_order_id', $ord_id)->firstOrFail();
        $ord->rzp_status = $request->payload->order->entity->status ?? '';
        $ord->save();
        return response()->json(['success' => true]);
    }
}