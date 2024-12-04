<x-app-layout>
    <div class="user-dashboard">
        <h1>User Dashboard</h1>
        <p>Welcome, {{Auth::user()->name}}!</p>
    </div>
    <div>
        <nav>
            <a href="/cart">Cart</a>
            <a href="/orders">Orders</a>
        </nav>

        <div class="container">
            <aside class="sidebar">
                <h3>Categories</h3>
                <ul>
                    @foreach($categories as $category)
                        <li><a href="{{ route('user.dashboard', ['id' => $category->category_id]) }}">Category {{ $category->category_id }}</a></li>
                    @endforeach
                </ul>
            </aside>

            <main class="products">
                <h1>Products</h1>
                @foreach($products as $product)
                    <div class="product-card">
                        <h2>{{ $product->name }}</h2>
                        <p>{{ $product->description }}</p>
                        <p>Price: ${{ $product->price }}</p>
                        <p>Stock: {{ $product->stock }}</p>
                        <form action="{{ route('user.add_to_cart') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <label for="quantity_{{ $product->id }}">Quantity:</label>
                            <input type="number" name="quantity" id="quantity_{{ $product->id }}" min="1" max="{{ $product->stock }}">
                            <button type="submit">Add to Cart</button>
                        </form>
                    </div>
                @endforeach
            </main>
        </div>
    </div>
</x-app-layout>