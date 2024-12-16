<x-app-layout>
    <div class="container mx-auto p-6">
        <!-- Page Title -->
        <h1 class="text-3xl font-bold mb-6 text-center">Your Orders</h1>

        <!-- Orders Loop -->
        @forelse($orders as $order)
            <div class="bg-white shadow-lg rounded-lg mb-6 p-6">
                <!-- Order Header -->
                <div class="flex justify-between items-center border-b pb-4 mb-4">
                    <h5 class="text-xl font-semibold">Order ID: {{ $order->id }}</h5>
                    <p class="text-lg font-semibold text-gray-700">
                        <strong>Total Price:</strong> ${{ number_format($order->orderitems->sum(function($item) { return $item->price; }), 2) }}
                    </p>
                </div>

                <!-- Order Items -->
                <div class="space-y-4">
                    <h6 class="text-lg font-medium">Order Items:</h6>
                    <ul class="space-y-2">
                        @forelse($order->orderitems as $item)
                            <li class="flex justify-between p-4 border rounded-md bg-gray-50">
                                <div class="flex-1">
                                    <strong>Product:</strong> {{ $item->product->name ?? 'N/A' }} <br>
                                    <strong>Quantity:</strong> {{ $item->quantity }} <br>
                                    <strong>Price:</strong> ${{ number_format($item->price, 2) }}
                                </div>
                            </li>
                        @empty
                            <p>No items in this order.</p>
                        @endforelse
                    </ul>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500">You have no orders yet.</p>
        @endforelse
    </div>
</x-app-layout>
