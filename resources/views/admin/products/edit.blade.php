<x-app-layout>
    <div class="edit-product">
        <h1>Edit Product</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.products.edit', $product->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Product Name</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="{{ old('name', $product->name) }}" 
                    class="w-full border border-gray-300 px-4 py-2 rounded" 
                    required 
                    placeholder="Enter product name"
                >
            </div>
            <div class="mb-4">
                <label for="price" class="block text-gray-700">Product Price</label>
                <input 
                    type="number" 
                    name="price" 
                    id="price" 
                    value="{{ old('price', $product->price) }}" 
                    class="w-full border border-gray-300 px-4 py-2 rounded" 
                    required 
                    placeholder="Enter product price"
                >
            </div>
            <div class="mb-4">
                <label for="stock" class="block text-gray-700">Stock Quantity</label>
                <input 
                    type="number" 
                    name="stock" 
                    id="stock" 
                    value="{{ old('stock', $product->stock) }}" 
                    class="w-full border border-gray-300 px-4 py-2 rounded" 
                    required 
                    placeholder="Enter stock quantity"
                >
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700">Product Description</label>
                <textarea 
                    name="description" 
                    id="description" 
                    class="w-full border border-gray-300 px-4 py-2 rounded" 
                    required 
                    placeholder="Enter product description"
                >{{ old('description', $product->description) }}</textarea>
            </div>
            <div class="mb-4">
                <label for="category_id" class="block text-gray-700">Category ID</label>
                <input 
                    type="number" 
                    name="category_id" 
                    id="category_id" 
                    value="{{ old('category_id', $product->category_id) }}" 
                    class="w-full border border-gray-300 px-4 py-2 rounded" 
                    required 
                    placeholder="Enter category ID"
                >
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                Update Product
            </button>
        </form>

        <div class="mt-4">
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                Back to Dashboard
            </a>
        </div>
    </div>
</x-app-layout>
