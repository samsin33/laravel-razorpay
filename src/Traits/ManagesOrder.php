<?php

namespace Samsin33\Razorpay\Traits;

use Samsin33\Razorpay\Exceptions\InvalidAmount;
use Samsin33\Razorpay\Exceptions\OrderException;
use Samsin33\Razorpay\Services\OrderApi;

trait ManagesOrder
{
    protected $customer_id_field = 'customer_id';

    /**
     * Retrieve the customer ID field name from your orders table.
     *
     * @return string
     */
    public function getCustomerIdField(): string
    {
        return $this->customer_id_field;
    }

    /**
     * Set the customer ID field name if not "customer_id" from your orders table.
     *
     * @param string $customer_id_field
     * @return bool
     */
    public function setCustomerIdField(string $customer_id_field)
    {
        $this->customer_id_field = $customer_id_field;
        return true;
    }

    /**
     * Retrieve the customer ID from your orders table which will be the foreign key references customers table.
     *
     * @return string|null
     */
    public function customerId()
    {
        $customer_id_field = $this->getCustomerIdField();
        return $this->{$customer_id_field};
    }

    /**
     * Retrieve the Razorpay order ID.
     *
     * @return string|null
     */
    public function razorpayOrderId()
    {
        return $this->razorpay_order_id;
    }

    /**
     * Determine if the entity has a Razorpay order ID.
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
        return isset($this->currency) && !empty($this->currency) ? $this->currency : config('razorpay.currency');
    }

    /**
     * Create a Razorpay order for the given object.
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

        if (!(isset($options['amount']) && $options['amount'] > 0)) {
            $options['amount'] = $this->amount ?? 0;
            if (!($options['amount'] > 0)) {
                throw InvalidAmount::wrongAmount();
            }
        }

        if (! array_key_exists('currency', $options)) {
            $options['currency'] = $this->getCurrency();
        }

        if (! array_key_exists('receipt', $options)) {
            $options['receipt'] = $this->id ?? '';
        }

        // Here we will create the order instance on Razorpay and store the ID of the
        // order from Razorpay. This ID will correspond with the Razorpay order instances
        // and allow us to retrieve orders from Razorpay later when we need to work.
        $api = new OrderApi();
        $order = $api->createOrder($options);

        $this->razorpay_order_id = $order->id;

        $this->saveQuietly();

        return $order;
    }

    /**
     * Get a Razorpay order for the given object.
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
     * Get a Razorpay payments for the given order.
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