<button id="rzp-button">Pay</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
        "key": "{{ config('razorpay.key') }}", // Enter the Key ID generated from the Dashboard
        "amount": "{{ $amount }}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
        "currency": "{{ $currency }}",
        "name": "{{ $name ?? config('app.name') }}",
        "description": "{{ $description }}",
        "image": "{{ $image_url }}",
        "order_id": {{ $order_id }}, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
        "handler": function (response){
        },
        "customer_id": "{{ $customer_id }}",
        "notes": {
            "address": "Razorpay Corporate Office"
        },
        "theme": {
            "color": "#3399cc"
        }
    };
    var rzp1 = new Razorpay(options);
    rzp1.on('payment.failed', function (response){
    });
    document.getElementById('rzp-button').onclick = function(e){
        rzp1.open();
        e.preventDefault();
    }
</script>
