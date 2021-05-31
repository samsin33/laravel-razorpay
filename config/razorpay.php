<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Razorpay Keys
    |--------------------------------------------------------------------------
    |
    | The Razorpay publishable key and secret key give you access to Razorpay's
    | API. The "publishable" key is typically used when interacting with
    | Razorpay.js while the "secret" key accesses private API endpoints.
    |
    */

    'key' => env('RAZORPAY_KEY'),

    'secret' => env('RAZORPAY_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | Razorpay Path
    |--------------------------------------------------------------------------
    |
    | This is the base URI path where Razorpay's views, such as the payment
    | verification screen, will be available from. You're free to tweak
    | this path according to your preferences and application design.
    |
    */

    'path' => env('RAZORPAY_PATH', 'razorpay'),

    /*
    |--------------------------------------------------------------------------
    | Razorpay Connection
    |--------------------------------------------------------------------------
    |
    | This is the db connection in your application that connects with
    | provided by Razorpay. It will serve as the primary connection you use while
    | interacting with Razorpay related models, migrations, and so on.
    |
    */

    'db_connection' => env('RAZORPAY_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Razorpay Webhooks
    |--------------------------------------------------------------------------
    |
    | Your Razorpay webhook secret is used to prevent unauthorized requests to
    | your Razorpay webhook handling controllers. The tolerance setting will
    | check the drift between the current time and the signed request's.
    |
    */

    'webhook' => [
        'secret' => env('RAZORPAY_WEBHOOK_SECRET'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Razorpay Model
    |--------------------------------------------------------------------------
    |
    | This is the model in your application that implements the Billable trait
    | provided by Razorpay. It will serve as the primary model you use while
    | interacting with Razorpay related methods, subscriptions, and so on.
    |
    */

    'model' => env('RAZORPAY_MODEL', App\Models\User::class),

    /*
    |--------------------------------------------------------------------------
    | Razorpay Model
    |--------------------------------------------------------------------------
    |
    | This is the model in your application that implements the Orderable trait
    | provided by Razorpay. It will serve as the primary model which will save
    | information regarding orders.
    |
    */

    'order_model' => env('RAZORPAY_ORDER_MODEL', App\Models\Order::class),

    /*
    |--------------------------------------------------------------------------
    | Currency
    |--------------------------------------------------------------------------
    |
    | This is the default currency that will be used when generating charges
    | from your application. Of course, you are welcome to use any of the
    | various world currencies that are currently supported via Razorpay.
    |
    */

    'currency' => env('RAZORPAY_CURRENCY', 'INR'),

    /*
    |--------------------------------------------------------------------------
    | Currency Locale
    |--------------------------------------------------------------------------
    |
    | This is the default locale in which your money values are formatted in
    | for display. To utilize other locales besides the default en locale
    | verify you have the "intl" PHP extension installed on the system.
    |
    */

    'currency_locale' => env('RAZORPAY_CURRENCY_LOCALE', 'en'),

    /*
    |--------------------------------------------------------------------------
    | Payment Confirmation Notification
    |--------------------------------------------------------------------------
    |
    | If this setting is enabled, Razorpay will automatically notify customers
    | whose payments require additional verification. You should listen to
    | Razorpay's webhooks in order for this feature to function correctly.
    |
    */

    'payment_notification' => env('RAZORPAY_PAYMENT_NOTIFICATION'),

    /*
    |--------------------------------------------------------------------------
    | Invoice Paper Size
    |--------------------------------------------------------------------------
    |
    | This option is the default paper size for all invoices generated using
    | Razorpay. You are free to customize this settings based on the usual
    | paper size used by the customers using your Laravel applications.
    |
    | Supported sizes: 'letter', 'legal', 'A4'
    |
    */

    'paper' => env('RAZORPAY_PAPER', 'letter'),

    /*
    |--------------------------------------------------------------------------
    | Razorpay Logger
    |--------------------------------------------------------------------------
    |
    | This setting defines which logging channel will be used by the Razorpay
    | library to write log messages. You are free to specify any of your
    | logging channels listed inside the "logging" configuration file.
    |
    */

    'logger' => env('RAZORPAY_LOGGER'),

];
