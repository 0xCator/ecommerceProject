<x-app-layout>
    <div class="container mx-auto p-6">
        <!-- Title -->
        <h1 class="text-3xl font-bold mb-6 text-center">Your Shopping Cart</h1>

        <!-- Cart Table -->
        <div class="overflow-x-auto shadow-lg rounded-lg">
            <table class="w-full text-sm text-left text-gray-500" style="background-color: #f9f9f9;">
                <!-- Table Header -->
                <thead class="text-xs text-gray-700 uppercase" style="background-color: #e5e7eb;">
                    <tr>
                        <th scope="col" class="px-6 py-3">Product</th>
                        <th scope="col" class="px-6 py-3">Quantity</th>
                        <th scope="col" class="px-6 py-3">Price (Per Unit)</th>
                        <th scope="col" class="px-6 py-3">Total</th>
                        <th scope="col" class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>

                <!-- Table Body -->
                <tbody>
                    @foreach ($orderItems as $item)
                        <tr class="border-b" style="background-color: #ffffff;">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $item->product->name }}
                            </th>
                            <td class="px-6 py-4">
                                <form action="{{ route('user.cart.update', $item->id) }}" method="POST" class="flex items-center">
                                    @csrf
                                    <input type="number" 
                                        name="quantity" 
                                        value="{{ $item->quantity }}" 
                                        min="1" 
                                        class="w-16 border-gray-300 rounded-md text-center"
                                    >
                                    <button type="submit" 
                                        class="ml-2 px-2 py-1 text-white bg-blue-500 hover:bg-blue-600 rounded">
                                        Update
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4">
                                ${{ number_format($item->product->price, 2) }}
                            </td>
                            <td class="px-6 py-4">
                                ${{ number_format($item->price, 2) }}
                            </td>
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

                        <!-- Notes Row -->
                        @if (isset($item->note))
                            <tr>
                                <td colspan="5" class="text-red-600 italic text-sm py-2 px-6">
                                    {{ $item->note }}
                                </td>
                            </tr>
                        @endif
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
                            <form action="{{ route('user.cart.place-order') }}" method="POST">
                                @csrf
                                <button type="submit" 
                                    class="px-4 py-2 bg-emerald-500 text-white hover:bg-emerald-800">
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
    </div>
</x-app-layout>
