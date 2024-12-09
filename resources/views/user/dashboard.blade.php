<x-app-layout>
    <div class="user-dashboard">
        <h1>User Dashboard</h1>
        <p>Welcome, {{ Auth::user()->name }}!</p>
    </div>
    <div>
        <nav>
        <a href="{{ route('cart.panel') }}" class="btn btn-primary">Display Cart</a>
        </nav>
        <nav>
        <a href="{{ route('order.panel') }}" class="btn btn-primary">Display Orders</a>
        </nav>

        <div class="container">
            <aside class="sidebar">
                <h3>Categories</h3>
                <ul>
                    <li><a href="{{ route('user.dashboard') }}">All Products</a></li> <!-- Link to show all products -->
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('user.dashboard', ['id' => $category->id]) }}">
                                Category {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <h3>Filter by Price</h3>
                <form action="{{ route('user.dashboard') }}" method="GET"> 
                    <label for="min_price">Min Price:</label>
                    <input type="number" name="min_price" id="min_price" min="0" value="{{ request('min_price') }}">
                    <label for="max_price">Max Price:</label>
                    <input type="number" name="max_price" id="max_price" min="0" value="{{ request('max_price') }}">
                    <button type="submit">Apply</button>
                    <a href="{{ route('user.dashboard') }}" class="reset-price-range">Reset</a> <!-- Reset button -->
                </form>
            </aside>

            <main class="products">
                <h1>Products</h1>
                <div class="search-bar">
                    <form action="{{ route('user.dashboard') }}" method="GET">
                        <input type="text" name="search" placeholder="Search products..." value="{{ request('search') }}">
                        <button type="submit">Search</button>
                    </form>
                </div>
                @forelse($products as $product)
                    <div class="product-card">
                        <h2>{{ $product->name }}</h2>
                        <p>{{ $product->description }}</p>
                        <p>Price: ${{ number_format($product->price) }}</p>
                        <p>Stock: {{ $product->stock }}</p>
                        <form action="{{ route('user.add_to_cart') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <label for="quantity_{{ $product->id }}">Quantity:</label>
                            <input type="number" name="quantity" id="quantity_{{ $product->id }}" min="1" max="{{ $product->stock }}">
                            <button type="submit">Add to Cart</button>
                        </form>
                    </div>
                @empty
                    <p>No products found matching your criteria.</p>
                @endforelse
            </main>
        </div>
    </div>
</x-app-layout>
