<?php

namespace Samsin33\Razorpay\Traits;

use Samsin33\Razorpay\Exceptions\CustomerException;
use Samsin33\Razorpay\Razorpay;
use Samsin33\Razorpay\Services\CustomerApi;

trait ManagesCustomer
{
    /**
     * Retrieve the Razorpay customer ID.
     *
     * @return string|null
     */
    public function razorpayCustomerId()
    {
        return $this->razorpay_customer_id;
    }

    /**
     * Get the email address used to create the customer in Razorpay.
     *
     * @return string|null
     */
    public function razorpayEmail()
    {
        return $this->email;
    }

    /**
     * Determine if the entity has a Razorpay customer ID.
     *
     * @return bool
     */
    public function hasRazorpayCustomerId()
    {
        return ! is_null($this->razorpay_customer_id);
    }

    /**
     * Determine if the entity has a Razorpay customer ID and throw an exception if not.
     *
     * @return void
     *
     * @throws \Samsin33\Razorpay\Exceptions\CustomerException
     */
    protected function assertCustomerExists()
    {
        if (! $this->hasRazorpayCustomerId()) {
            throw CustomerException::notYetCreated($this);
        }
    }

    /**
     * Create a Razorpay customer for the given model.
     *
     * @param  array  $options
     * @return CustomerApi
     *
     * @throws \Samsin33\Razorpay\Exceptions\CustomerException
     */
    public function createRazorpayCustomer(array $options = [])
    {
        if ($this->hasRazorpayCustomerId()) {
            throw CustomerException::exists($this);
        }

        if (! array_key_exists('email', $options) && $email = $this->razorpayEmail()) {
            $options['email'] = $email;
        }

        if (!isset($options['name']) || empty($options['name'])) {
            $options['name'] = $this->name ?? '';
        }

        if (!isset($options['contact']) || empty($options['contact'])) {
            $options['contact'] = $this->mobile ?? $this->contact ?? '';
        }

        // Here we will create the customer instance on Razorpay and store the ID of the
        // user from Razorpay. This ID will correspond with the Razorpay user instances.
        $api = new CustomerApi();
        $customer = $api->createCustomer($options);

        $this->razorpay_customer_id = $customer->id;

        $this->saveQuietly();

        return $customer;
    }

    /**
     * Update the underlying Razorpay customer information for the model.
     *
     * @param  array  $options
     * @return CustomerApi
     */
    public function updateRazorpayCustomer(array $options = [])
    {
        $api = new CustomerApi();
        $customer = $api->editCustomer($this->razorpayCustomerId(), $options);
        return $customer;
    }

    /**
     * Get the Razorpay customer instance for the current user or create one.
     *
     * @param  array  $options
     * @return CustomerApi
     */
    public function createOrGetRazorpayCustomer(array $options = [])
    {
        if ($this->hasRazorpayCustomerId()) {
            return $this->getRazorpayCustomer();
        }

        return $this->createRazorpayCustomer($options);
    }

    /**
     * Get the Razorpay customer for the model.
     *
     * @return CustomerApi
     */
    public function getRazorpayCustomer()
    {
        $this->assertCustomerExists();

        $api = new CustomerApi();
        return $api->getCustomer($this->razorpayCustomerId());
    }

    /**
     * Get the Razorpay supported currency used by the entity.
     *
     * @return string
     */
    public function preferredCurrency()
    {
        return config('razorpay.currency');
    }

    /**
     * Get the default Razorpay API options for the current Billable model.
     *
     * @param  array  $options
     * @return array
     */
    public function razorpayOptions(array $options = [])
    {
        return Razorpay::razorpayOptions($options);
    }
}