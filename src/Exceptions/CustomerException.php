<?php

namespace Samsin33\Razorpay\Exceptions;

use Exception;

class CustomerException extends Exception
{
    /**
     * Create a new CustomerAlreadyCreated instance.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $owner
     * @return static
     */
    public static function exists($owner)
    {
        return new static(class_basename($owner)." is already a Razorpay customer with ID {$owner->rzp_customer_id}.");
    }

    /**
     * Create a new InvalidCustomer instance.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $owner
     * @return static
     */
    public static function notYetCreated($owner)
    {
        return new static(class_basename($owner).' is not a Razorpay customer yet. See the createRazorpayCustomer method.');
    }
}