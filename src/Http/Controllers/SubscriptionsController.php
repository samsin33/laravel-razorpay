<?php

namespace Samsin33\Razorpay\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Samsin33\Razorpay\Models\Subscription;

class SubscriptionsController extends Controller
{
    private function validateData($subscription)
    {
        $validate = Validator::make($subscription, [
            'plan_id' => 'required|integer',
            'total_count' => 'required|integer',
            'quantity' => 'required|integer',
            'customer_notify' => 'required|integer',
            'start_at' => 'required|integer',
            'expire_by' => 'required|integer',
        ]);
        if ($validate->fails()) {
            $validate->errors()->toArray();
        } else {
            return false;
        }
    }

    public function store(Request $request)
    {
        $subscription = new Subscription($request->plan);
        if ($valid = $this->validateData($subscription->toArray())) {
            return response()->json($valid, 422);
        }
        $append_subscription = isset($request->append_subscription) && is_array($request->append_subscription) && !empty($request->append_subscription)
            ? $request->append_subscription : [];
        $subscription->saveSubscription($append_subscription);
        return response()->json($subscription);
    }

    public function show($id)
    {
        $subscription = Subscription::firstOrFail($id);
        return response()->json($subscription);
    }
}
