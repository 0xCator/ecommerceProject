<x-app-layout>
    <div class="bg-gray-100 min-h-screen">
        <!-- User Dashboard Header -->
        <div class="bg-white shadow-md p-6 mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 ml-16 pl-2">Welcome, {{ Auth::user()->name }}!</h1>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('cart.panel') }}" 
                   class="bg-emerald-800 text-white px-4 py-2 hover:bg-emerald-500 transition">
                    Display Cart
                </a>
                <a href="{{ route('order.panel') }}" 
                   class="bg-blue-600 text-white px-4 py-2 hover:bg-blue-700 transition">
                    Display Orders
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto flex flex-col lg:flex-row gap-6">
            <!-- Sidebar -->
            <aside class="bg-white p-6 shadow-md w-full lg:w-1/4">
                <!-- Categories -->
                <h3 class="text-lg font-semibold mb-4 text-gray-700">Categories</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('user.dashboard') }}" 
                           class="text-blue-600 hover:underline">
                            All Products
                        </a>
                    </li>
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('user.dashboard', ['id' => $category->id]) }}" 
                               class="text-blue-600 hover:underline">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <!-- Price Filter -->
                <h3 class="text-lg font-semibold mt-6 mb-4 text-gray-700">Filter by Price</h3>
                <form action="{{ route('user.dashboard') }}" method="GET" class="space-y-4">
                    <div>
                        <label for="min_price" class="block text-gray-600">Min Price:</label>
                        <input type="number" name="min_price" id="min_price" min="0"
                               value="{{ request('min_price') }}" 
                               class="w-full border px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="max_price" class="block text-gray-600">Max Price:</label>
                        <input type="number" name="max_price" id="max_price" min="0"
                               value="{{ request('max_price') }}" 
                               class="w-full border px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <button type="submit" 
                            class="bg-blue-600 text-white px-4 py-2 hover:bg-blue-700">
                        Apply
                    </button>
                </form>
            </aside>

            <!-- Products Section -->
            <main class="flex-1">
                <!-- Search Bar and Reset -->
                <div class="flex justify-between items-center mb-6 bg-white p-4 shadow-md">
                    <form action="{{ route('user.dashboard') }}" method="GET" class="flex w-full">
                        <input type="text" name="search" placeholder="Search products..." 
                            value="{{ request('search') }}"
                            class="w-full border px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="submit" 
                                class="bg-blue-600 text-white px-4 hover:bg-blue-700">
                            Search
                        </button>
                    </form>
                    <a href="{{ route('user.dashboard') }}" 
                    class="text-blue-600 hover:underline ml-4">
                        Reset
                    </a>
                </div>

                <!-- Product Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @forelse($products as $product)
                        <div class="bg-white shadow-md p-4 hover:shadow-lg transition">
                            <!-- Multiimage Carousel -->
                            <div x-data="{ currentImage: 0 }" class="relative mb-4">
                                <div class="relative w-full h-48">
                                    <template x-for="(image, index) in {{ $product->multiimages }}" :key="index">
                                        <img x-show="currentImage === index" 
                                            :src="'{{ asset('upload/products/') }}/' + image.name" 
                                            alt="{{ $product->name }}" 
                                            class="w-full h-48 object-cover">
                                    </template>
                                </div>

                                <!-- Navigation Buttons -->
                                <button @click="currentImage = (currentImage - 1 + {{ $product->multiimages->count() }}) % {{ $product->multiimages->count() }}"
                                        class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-2 py-1 shadow-md hover:bg-gray-700">
                                    &larr;
                                </button>
                                <button @click="currentImage = (currentImage + 1) % {{ $product->multiimages->count() }}"
                                        class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-2 py-1 shadow-md hover:bg-gray-700">
                                    &rarr;
                                </button>
                            </div>

                            <!-- Product Details -->
                            <h2 class="text-lg font-bold text-gray-800">{{ $product->name }}</h2>
                            <p class="text-sm text-gray-600">{{ $product->description }}</p>
                            <p class="text-blue-600 font-semibold mt-2">Price: ${{ number_format($product->price) }}</p>
                            <p class="text-gray-600">
                                Stock: 
                                @if($product->stock > 0)
                                    {{ $product->stock }}
                                @else
                                    <span class="text-red-600 font-bold">Out of Stock</span>
                                @endif
                            </p>

                            <!-- Add to Cart -->
                            @if($product->stock > 0)
                                <form action="{{ route('user.add_to_cart') }}" method="POST" class="mt-4">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <label for="quantity_{{ $product->id }}" class="text-sm text-gray-600">Quantity:</label>
                                    <input type="number" name="quantity" id="quantity_{{ $product->id }}" min="1" max="{{ $product->stock }}"
                                        class="w-full border px-2 py-1 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <button type="submit" 
                                            class="mt-2 w-full bg-emerald-800 text-white px-4 py-2 hover:bg-emerald-500">
                                        Add to Cart
                                    </button>
                                </form>
                            @else
                                <button disabled 
                                        class="mt-4 w-full bg-gray-400 text-white px-4 py-2 cursor-not-allowed">
                                    Out of Stock
                                </button>
                            @endif
                        </div>
                    @empty
                        <p class="col-span-full text-center text-gray-600">No products found matching your criteria.</p>
                    @endforelse
                </div>
            </main>

        </div>
    </div>
</x-app-layout>
