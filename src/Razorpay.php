<?php

namespace Samsin33\Razorpay;

class Razorpay
{
    /**
     * The Razorpay library version.
     *
     * @var string
     */
    const VERSION = '2.0.0';

    /**
     * The Razorpay API version.
     *
     * @var string
     */
    const RAZORPAY_VERSION = '2021-05-26';

    /**
     * The custom currency formatter.
     *
     * @var callable
     */
    protected static $formatCurrencyUsing;

    /**
     * Indicates if Razorpay migrations will be run.
     *
     * @var bool
     */
    public static $runsMigrations = true;

    /**
     * Indicates if Razorpay routes will be registered.
     *
     * @var bool
     */
    public static $registersRoutes = true;

    /**
     * Indicates if Razorpay will mark past due subscriptions as inactive.
     *
     * @var bool
     */
    public static $deactivatePastDue = true;

    /**
     * Get the billable entity instance by Razorpay ID.
     *
     * @param string $razorpay_id
     * @return Billable|null
     */
    public static function findBillable($razorpay_id)
    {
        if ($razorpay_id === null) {
            return null;
        }

        $model = config('razorpay.model');

        return (new $model)->where('rzp_customer_id', $razorpay_id)->first();
    }

    /**
     * Get the default Razorpay API options.
     *
     * @param array $options
     * @return array
     */
    public static function razorpayOptions(array $options = [])
    {
        return array_merge([
            'api_key' => config('razorpay.secret'),
            'razorpay_version' => static::RAZORPAY_VERSION,
        ], $options);
    }

    /**
     * Set the custom currency formatter.
     *
     * @param callable $callback
     * @return void
     */
    public static function formatCurrencyUsing(callable $callback)
    {
        static::$formatCurrencyUsing = $callback;
    }

    /**
     * Configure Razorpay to not register its migrations.
     *
     * @return static
     */
    public static function ignoreMigrations()
    {
        static::$runsMigrations = false;

        return new static;
    }

    /**
     * Configure Razorpay to not register its routes.
     *
     * @return static
     */
    public static function ignoreRoutes()
    {
        static::$registersRoutes = false;

        return new static;
    }

    /**
     * Configure Razorpay to maintain past due subscriptions as active.
     *
     * @return static
     */
    public static function keepPastDueSubscriptionsActive()
    {
        static::$deactivatePastDue = false;

        return new static;
    }
}