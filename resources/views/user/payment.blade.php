<x-app-layout>
    <div class="bg-gray-100 min-h-screen">
        <!-- Header -->
        <div class="bg-white shadow-md p-6 mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800 ml-16 pl-2">Payment Details</h1>
        </div>

        <!-- Payment Form -->
        <div class="container mx-auto flex justify-center">
            <div class="bg-white p-6 shadow-md w-full max-w-lg">
                <form action="{{ route('user.cart.place-order') }}" method="POST">
                    @csrf

                    <!-- Address Line -->
                    <div class="mb-4">
                        <label for="address" class="block text-gray-700 font-semibold mb-2">Address Line:</label>
                        <textarea id="address" name="address" placeholder="Apt, Street, City, Zip"
                                  class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                    </div>

                    <!-- Phone Number -->
                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700 font-semibold mb-2">Phone Number:</label>
                        <input type="text" id="phone" name="phone" placeholder="+20 000 000 0000"
                               class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <!-- Payment Method -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Payment Method:</label>
                        <div class="flex items-center gap-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="payment_method" value="credit_card" checked id="credit_card_option">
                                <span class="ml-2 text-gray-600">Credit Card</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="payment_method" value="paypal" id="paypal_option">
                                <span class="ml-2 text-gray-600">Cash On Delivery</span>
                            </label>
                        </div>
                    </div>

                    <!-- Credit Card Payment Details -->
                    <div id="credit_card_details">
                        <!-- Name on Card -->
                        <div class="mb-4">
                            <label for="card_name" class="block text-gray-700 font-semibold mb-2">Name on Card:</label>
                            <input type="text" id="card_name" name="card_name" placeholder="John Doe"
                                   class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Card Number -->
                        <div class="mb-4">
                            <label for="card_number" class="block text-gray-700 font-semibold mb-2">Card Number:</label>
                            <input type="text" id="card_number" name="card_number" placeholder="1234 5678 9012 3456"
                                   class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Expiration Date and CVV -->
                        <div class="flex gap-4 mb-4">
                            <div class="w-1/2">
                                <label for="exp_date" class="block text-gray-700 font-semibold mb-2">Expiry Date:</label>
                                <input type="text" id="exp_date" name="exp_date" placeholder="MM/YY"
                                       class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="w-1/2">
                                <label for="cvv" class="block text-gray-700 font-semibold mb-2">CVV:</label>
                                <input type="text" id="cvv" name="cvv" placeholder="123"
                                       class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full bg-emerald-800 text-white px-4 py-2 hover:bg-emerald-500 transition">
                        Complete Payment
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript for Conditional Form Display -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const creditCardOption = document.getElementById('credit_card_option');
            const paypalOption = document.getElementById('paypal_option');
            const creditCardDetails = document.getElementById('credit_card_details');

            function togglePaymentDetails() {
                if (creditCardOption.checked) {
                    creditCardDetails.style.display = 'block';
                } else {
                    creditCardDetails.style.display = 'none';
                }
            }

            // Attach event listeners to radio buttons
            creditCardOption.addEventListener('change', togglePaymentDetails);
            paypalOption.addEventListener('change', togglePaymentDetails);

            // Initial check on page load
            togglePaymentDetails();
        });
    </script>
</x-app-layout>
