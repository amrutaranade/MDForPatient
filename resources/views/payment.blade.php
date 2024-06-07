<!-- resources/views/payment.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Stripe Payment</title>
</head>
<body>
    <h1>Stripe Payment</h1>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div>{{ session('error') }}</div>
    @endif

    <form action="{{ route('stripe.post') }}" method="POST">
        @csrf
        <label for="amount">Amount:</label>
        <input type="number" name="amount" id="amount" required>
        <br>
        <script
            src="https://checkout.stripe.com/checkout.js"
            class="stripe-button"
            data-key="{{ env('STRIPE_KEY') }}"
            data-name="Laravel Stripe Integration"
            data-description="Payment Integration"
            data-amount="0"
            data-locale="auto">
        </script>
    </form>
</body>
</html>
