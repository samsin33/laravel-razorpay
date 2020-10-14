<?php

namespace Samsin33\Razorpay\Exceptions;

use Exception;

class OrderException extends Exception
{
    /**
     * Create a new CustomerAlreadyCreated instance.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $owner
     * @return static
     */
    public static function exists($order)
    {
        return new static(class_basename($order)." is already a Razorpay order with ID {$order->razorpay_order_id}.");
    }

    public static function notExists($order)
    {
        return new static(class_basename($order)." does not have a Razorpay order.");
    }
}