<x-app-layout>
    <div class="container">
        <h1>Your Orders</h1>

        @forelse($orders as $order)
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Order ID: {{ $order->id }}</h5>
                    <p>
                        <strong>Total Price:</strong> $
                        {{ number_format($order->orderitems->sum(function($item) {
                            return $item->price;
                        }), 2) }}
                    </p>    
                </div>
                <div class="card-body">
                    <h6>Order Items:</h6>
                    <ul>
                        @forelse($order->orderitems as $item)
                            <li>
                                <strong>Product:</strong> {{ $item->product->name ?? 'N/A' }} <br>
                                <strong>Quantity:</strong> {{ $item->quantity }} <br>
                                <strong>Price:</strong> ${{ number_format($item->price, 2) }}
                            </li>
                        @empty
                            <p>No items in this order.</p>
                        @endforelse
                    </ul>
                </div>
            </div>
        @empty
            <p>You have no orders yet.</p>
        @endforelse
    </div>
</x-app-layout>
