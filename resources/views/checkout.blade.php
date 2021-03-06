<button id="rzp-button">{{ $btn_text ?? 'Pay' }}</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
        "key": "{{ config('razorpay.key') }}", // Enter the Key ID generated from the Dashboard
        "amount": "{{ $amount }}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
        "currency": "{{ $currency ?? config('razorpay.currency') }}",
        "name": "{{ $name ?? config('app.name') }}",
        "description": "{{ $description }}",
        "image": "{{ $image_url }}",
        "order_id": "{{ $rzp_order_id }}", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
        "customer_id": "{{ $rzp_customer_id }}",
        "callback_url": "{{ $callback_url }}",
        "notes": {
            "address": "{{ $address ?? '' }}"
        },
        "theme": {
            "color": "{{ $color ?? '#3399cc' }}"
        }
    };
    var rzp = new Razorpay(options);
    document.getElementById('rzp-button').onclick = function(e){
        rzp.open();
        e.preventDefault();
    }
</script>
