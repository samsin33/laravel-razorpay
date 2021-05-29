<form action="{{ $route }}" method="POST">
    <script src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="{{ config('razorpay.key') }}"
    data-amount="{{ $amount }}"
    data-currency="{{ $currency ?? config('razorpay.currency') }}"
    data-order_id="{{ $razorpay_order_id }}"
    data-buttontext="{{ $btn_text ?? 'Pay' }}"
    data-name="{{ $name ?? config('app.name') }}"
    data-description="{{ $description }}"
    data-image="{{ $image_url }}"
    data-customer_id="{{ $razorpay_customer_id }}"
    data-theme.color="#F37254"
    ></script>
    <input type="hidden" custom="Hidden Element" name="hidden">
</form>