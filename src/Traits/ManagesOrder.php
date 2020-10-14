<?php

namespace Samsin33\Razorpay\Traits;

use Samsin33\Razorpay\Exceptions\InvalidAmount;
use Samsin33\Razorpay\Exceptions\OrderException;
use Samsin33\Razorpay\Services\OrderApi;

trait ManagesOrder
{
    /**
     * Retrieve the Razorpay customer ID.
     *
     * @return string|null
     */
    public function razorpayOrderId()
    {
        return $this->razorpay_order_id;
    }

    /**
     * Determine if the entity has a Razorpay customer ID.
     *
     * @return bool
     */
    public function hasRazorpayOrderId()
    {
        return ! is_null($this->razorpay_order_id);
    }

    /**
     * Get the Razorpay supported currency used by the entity.
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency ?? config('razorpay.currency');
    }

    /**
     * Create a Razorpay customer for the given model.
     *
     * @param  array  $options
     * @return OrderApi
     *
     * @throws \Samsin33\Razorpay\Exceptions\InvalidAmount
     * @throws \Samsin33\Razorpay\Exceptions\OrderException
     */
    public function createRazorpayOrder(array $options = [])
    {
        if ($this->hasRazorpayOrderId()) {
            throw OrderException::exists($this);
        }

        if (! array_key_exists('amount', $options) || !(isset($options['amount']) && $options['amount'] > 0)) {
            throw InvalidAmount::wrongAmount();
        }

        if (! array_key_exists('currency', $options)) {
            $options['currency'] = $this->getCurrency();
        }

        // Here we will create the customer instance on Razorpay and store the ID of the
        // user from Razorpay. This ID will correspond with the Razorpay user instances
        // and allow us to retrieve users from Razorpay later when we need to work.
        $api = new OrderApi();
        $order = $api->createOrder($options);

        $this->razorpay_order_id = $order->id;

        $this->save();

        return $order;
    }

    /**
     * Create a Razorpay customer for the given model.
     *
     * @return OrderApi
     *
     * @throws \Samsin33\Razorpay\Exceptions\OrderException
     */
    public function getRazorpayOrder()
    {
        if (!$this->hasRazorpayOrderId()) {
            throw OrderException::notExists($this);
        }

        $api = new OrderApi();
        return $api->getOrder($this->razorpayOrderId());
    }

    /**
     * Create a Razorpay customer for the given model.
     *
     * @return OrderApi
     *
     * @throws \Samsin33\Razorpay\Exceptions\OrderException
     */
    public function getRazorpayOrderPayments()
    {
        if (!$this->hasRazorpayOrderId()) {
            throw OrderException::notExists($this);
        }

        $api = new OrderApi();
        return $api->getOrderPayments($this->razorpayOrderId());
    }
}