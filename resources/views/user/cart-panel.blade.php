<x-app-layout>
    <div class="container mx-auto p-6">
        <!-- Title -->
        <h1 class="text-3xl font-bold mb-6 text-center">Your Shopping Cart</h1>
        <!-- Cart Table -->
        <div class="overflow-x-auto shadow-lg">
            <table class="w-full text-sm text-left text-gray-500" style="background-color: #f9f9f9;">
                <!-- Table Header -->
                <thead class="text-xs text-gray-700 uppercase" style="background-color: #e5e7eb;">
                    <tr>
                        <th scope="col" class="px-6 py-3">Product</th>
                        <th scope="col" class="px-6 py-3">Quantity</th>
                        <th scope="col" class="px-6 py-3">Price (Per Unit)</th>
                        <th scope="col" class="px-6 py-3">Subtotal</th>
                        <th scope="col" class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>

                <!-- Table Body -->
                <tbody>
                    @foreach ($orderItems as $item)
                    <tr class="border-b" style="background-color: #ffffff;">
                        <!-- Product Name -->
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $item->product->name }}
                            @if ($item->product->stock == 0)
                                <span class="text-red-600 font-bold">(Out of Stock)</span>
                            @endif
                        </th>
                
                        <!-- Quantity Input -->
                        <td class="px-6 py-4">
                            <form action="{{ route('user.cart.update', $item->id) }}" method="POST" class="flex items-center">
                                @csrf
                                <input type="number" 
                                       name="quantity" 
                                       value="{{ $item->quantity }}" 
                                       min="1" 
                                       max="{{ $item->product->stock > 0 ? $item->product->stock : $item->quantity }}"
                                       class="w-16 border-gray-300 text-center"
                                >
                                <button type="submit" 
                                        class="ml-2 px-2 py-1 text-white bg-blue-600 hover:bg-blue-700">
                                    Update
                                </button>
                            </form>
                            @if (isset($item->note)) <!-- Alert message if stock is insufficient -->
                                <p class="text-red-600 text-sm mt-1">{{ $item->note }}</p>
                            @endif
                        </td>
                
                        <!-- Price (Per Unit) -->
                        <td class="px-6 py-4">
                            ${{ number_format($item->product->price, 2) }}
                        </td>
                
                        <!-- Total Price -->
                        <td class="px-6 py-4">
                            ${{ number_format($item->price, 2) }}
                        </td>
                
                        <!-- Remove Button -->
                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('user.cart.remove', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" 
                                        class="text-red-600 hover:underline">
                                    Remove
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach                
                </tbody>

                <!-- Table Footer -->
                <tfoot class="bg-gray-100 font-semibold text-gray-800">
                    <tr>
                        <td colspan="3" class="py-4 px-6 text-right text-lg">Total</td>
                        <td class="py-4 px-6 text-lg">
                            ${{ number_format($orderItems->sum('price'), 2) }}
                        </td>
                        <td class="py-4 px-6 text-center">
                            <!-- Disable the "Place Order" button if any item is out of stock -->
                            <form action="{{ route('payment.page') }}" method="GET">
                                @csrf
                                <button type="submit" 
                                        class="px-4 py-2 bg-emerald-800 text-white hover:bg-emerald-500 {{ $outOfStock || $orderItems->isEmpty() ? 'opacity-50 cursor-not-allowed' : '' }}" 
                                        {{ $outOfStock || $orderItems->isEmpty() ? 'disabled' : '' }}>
                                    Place Order
                                </button>
                            </form>                            
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Back to Shopping Button -->
        <div class="mt-6 text-center">
            <a href="{{ route('user.dashboard') }}" 
               class="inline-block px-4 py-2 text-white bg-gray-600 hover:bg-gray-700">
                Back to Shopping
            </a>
        </div>

        <!-- Out of Stock Warning -->
        @if ($orderItems->contains(fn($item) => $item->product->stock == 0))
            <div class="mt-4 text-red-600 font-semibold text-center">
                <p>Some products in your cart are out of stock and cannot be updated or ordered.</p>
            </div>
        @endif
    </div>
</x-app-layout>
