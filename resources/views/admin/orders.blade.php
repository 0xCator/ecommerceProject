<x-app-layout>
    <div class="bg-gray-100 min-h-screen">
        <!-- User Dashboard Header -->
        <div class="bg-white shadow-md p-6 mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 ml-16 pl-2">Admin Dashboard</h1>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto flex flex-col lg:flex-row gap-6">
            <!-- Sidebar -->
            <aside class="bg-white p-6 shadow-md w-full lg:w-1/4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('products.index') }}" 
                           class="text-blue-600 hover:underline">
                            Products
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.index') }}" 
                           class="text-blue-600 hover:underline">
                            Categories
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.orders') }}" 
                           class="text-blue-600 hover:underline">
                            Orders
                        </a>
                    </li>
                </ul>
            </aside>

            <!-- Orders Section -->
            <main class="flex-1">
                <!-- Orders Loop -->
                @forelse($orders as $order)
                    <div class="bg-white shadow-lg mb-6 p-6">
                        <!-- Order Header -->
                        <div class="flex justify-between items-center border-b pb-4 mb-4">
                            <h5 class="text-xl font-semibold">Order ID: {{ $order->id }}</h5>
                            <p class="text-lg font-semibold text-gray-700">
                                <strong>User:</strong> {{ $order->user->name }}
                            </p>
                            <p class="text-lg font-semibold text-gray-700">
                                <strong>Total Price:</strong> ${{ number_format($order->orderitems->sum(function($item) { return $item->price; }), 2) }}
                            </p>
                        </div>

                        <!-- Order Items -->
                        <div class="space-y-4">
                            <h6 class="text-lg font-medium">Order Items:</h6>
                            <ul class="space-y-2">
                                @forelse($order->orderitems as $item)
                                    <li class="flex justify-between p-4 border bg-gray-50">
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
                    <p class="text-center text-gray-500">No orders have been made.</p>
                @endforelse
            </main>
        </div>
    </div>
</x-app-layout>
