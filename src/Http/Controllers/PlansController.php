<?php

namespace Samsin33\Razorpay\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Samsin33\Razorpay\Models\Plan;

class PlansController extends Controller
{
    private function validateData($plan)
    {
        $validate = Validator::make($plan, [
            'name' => 'required|string|max:255',
            'amount' => 'required|integer',
            'currency' => 'required|string|max:255',
            'description' => 'required|string',
            'period' => 'required|string|max:255',
            'interval' => 'required|integer',
        ]);
        if ($validate->fails()) {
            $validate->errors()->toArray();
        } else {
            return false;
        }
    }

    public function store(Request $request)
    {
        $plan = new Plan($request->plan);
        if ($valid = $this->validateData($plan->toArray())) {
            return response()->json($valid, 422);
        }
        $append_plan = isset($request->append_plan) && is_array($request->append_plan) && !empty($request->append_plan) ? $request->append_plan : [];
        $plan->savePlan($append_plan);
        return response()->json($plan);
    }

    public function show($id)
    {
        $plan = Plan::firstOrFail($id);
        return response()->json($plan);
    }
}