<?php

namespace Samsin33\Razorpay\Exceptions;

use Exception;

class InvalidAmount extends Exception
{
    /**
     * Create a new CustomerAlreadyCreated instance.
     *
     * @return static
     */
    public static function wrongAmount()
    {
        return new static('Amount must be numeric and greater than 0.');
    }
}