
## Introduction

Razorpay package for laravel. Supports razorpay integration with laravel version 8.

## Installation
Just install samsin33/laravel-razorpay package with composer.

```bash
$ composer require samsin33/laravel-razorpay
```

It uses razorpay/razorpay package and will be installed automatically.

## Database Migration
Razorpay service provider registers its own database migration directory, so remember to migrate your database after installing the package. The Cashier migrations will add several columns to your customers and orders table as well as create new plans and subscriptions table to hold all of your customer's subscriptions:

```bash
$ php artisan migrate
```

If you need to overwrite the migrations that ship with this package, you can publish them using the vendor:publish Artisan command:

```bash
$ php artisan vendor:publish --tag="razorpay-migrations"
```

If you would like to prevent Razorpay's migrations from running entirely, you may use the ignoreMigrations method provided by Razorpay. Typically, this method should be called in the register method of your AppServiceProvider:

```bash
use Laravel\Razorpay\Razorpay;

/**
 * Register any application services.
 *
 * @return void
 */
public function register()
{
    Razorpay::ignoreMigrations();
}
```

## Env Configuration

Razorpay assumes your customer model will be the App\Models\User class that ships with Laravel. If you wish to change this you can specify a different model in your .env file:

```bash
RAZORPAY_MODEL=App\Models\User
```

Razorpay assumes your order model will be the App\Models\Order class that ships with Laravel. If you wish to change this you can specify a different model in your .env file:

```bash
RAZORPAY_ORDER_MODEL=App\Models\Order
```

Next, you should configure your Razorpay API keys in your application's .env file. You can retrieve your Razorpay API keys from the Razorpay control panel:

```bash
RAZORPAY_KEY=your-razorpay-key
RAZORPAY_SECRET=your-razorpay-secret
```

The default razorpay currency is Indian Rupee (INR). You can change the default currency by setting the RAZORPAY_CURRENCY environment variable within your application's .env file:

```bash
CASHIER_CURRENCY=INR
```

## Model Configuration

Before using Razorpay, add the Billable trait to your customer model definition. Typically, this will be the App\Models\User model. This trait provides various methods to allow you to perform common tasks, such as fatching, creating and updating customer method information:

```bash
use Laravel\Razorpay\Billable;

class User extends Authenticatable
{
    use Billable;
}
```

Before using Razorpay, add the Orderable trait to your order model definition. Typically, this will be the App\Models\Order model. This trait provides various methods to allow you to perform common tasks, such as fatching, creating and updating order method information:

```bash
use Laravel\Razorpay\Orderable;

class Order extends Model
{
    use Orderable;
}
```

## Customers

### Retrieving Customers
You can retrieve a customer by their Razorpay ID using the Razorpay::findBillable method. This method will return an instance of the billable model:

```bash
use Laravel\Razorpay\Razorpay;

$user = Razorpay::findBillable($razorpayId);
```

### Creating Customers

You can create a Razorpay customer by using the createRazorpayCustomer method in a billable model:

```bash
$razorpay_customer = $user->createRazorpayCustomer($options);
```

You may use the getRazorpayCustomer method if you want to return the Razorpay customer object for a billable model:

```bash
$razorpay_customer = $user->getRazorpayCustomer();
```

## Orders

### Creating Orders

You can create a Razorpay order by using the createRazorpayOrder method in a orderable model:

```bash
$razorpay_order = $user->createRazorpayOrder($options);
```

You may use the getRazorpayOrder method if you want to return the Razorpay orders for a orderable model:

```bash
$razorpay_customer = $user->getRazorpayOrder();
```

You may use the getRazorpayOrderPayments method if you want to return the Razorpay order payments for a orderable model:

```bash
$razorpay_customer = $user->getRazorpayOrderPayments();
```
