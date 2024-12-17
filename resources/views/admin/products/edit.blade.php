<x-app-layout>
    <div class="container mx-auto flex justify-center items-start min-h-screen mt-8">
        <div class="w-1/2">
            <h1 class="text-2xl font-bold mb-4 text-center">Edit Product</h1>

            @if($errors->any())
            <div class="alert alert-danger text-center mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('admin.products.edit', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-sm">Product Name</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        value="{{ old('name', $product->name) }}" 
                        class="mt-1 block w-full border-gray-300 shadow-sm focus:border-emerald-400 focus:ring focus:ring-emerald-800 focus:ring-opacity-30" 
                        required 
                        placeholder="Enter product name"
                    >
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-sm">Product Price</label>
                    <input 
                        type="number" 
                        name="price" 
                        id="price" 
                        value="{{ old('price', $product->price) }}" 
                        class="mt-1 block w-full border-gray-300 shadow-sm focus:border-emerald-400 focus:ring focus:ring-emerald-800 focus:ring-opacity-30" 
                        required 
                        placeholder="Enter product price"
                    >
                </div>
                <div class="mb-4">
                    <label for="stock" class="block text-sm">Stock Quantity</label>
                    <input 
                        type="number" 
                        name="stock" 
                        id="stock" 
                        value="{{ old('stock', $product->stock) }}" 
                        class="mt-1 block w-full border-gray-300 shadow-sm focus:border-emerald-400 focus:ring focus:ring-emerald-800 focus:ring-opacity-30" 
                        required 
                        placeholder="Enter stock quantity"
                    >
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm">Product Description</label>
                    <textarea 
                        name="description" 
                        id="description" 
                        class="mt-1 block w-full border-gray-300 shadow-sm focus:border-emerald-400 focus:ring focus:ring-emerald-800 focus:ring-opacity-30" 
                        required 
                        placeholder="Enter product description"
                    >{{ old('description', $product->description) }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="category_id" class="block text-sm">Category ID</label>
                    <input 
                        type="number" 
                        name="category_id" 
                        id="category_id" 
                        value="{{ old('category_id', $product->category_id) }}" 
                        class="mt-1 block w-full border-gray-300 shadow-sm focus:border-emerald-400 focus:ring focus:ring-emerald-800 focus:ring-opacity-30" 
                        required 
                        placeholder="Enter category ID"
                    >
                </div>
                <div class="mb-4">
                <label class="block text-sm">Existing Images</label>
                <div class="flex flex-wrap gap-4">
                    @foreach ($product->multiimages as $image)
                        <div class="flex flex-col items-center">
                            <img src="{{ asset('upload/products/' . $image->name) }}" 
                                alt="Product Image" class="h-24 w-24 object-cover mb-2">
                            <label>
                                <input type="checkbox" name="delete_images[]" value="{{ $image->id }}">
                                Delete
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm">Add New Images</label>
                <input 
                    type="file" 
                    name="images[]" 
                    id="image" 
                    class="mt-1 block w-full border-gray-300 shadow-sm focus:border-emerald-400 focus:ring focus:ring-emerald-800 focus:ring-opacity-30" 
                    multiple
                >
            </div>
                <div class="mt-4">
                    <button 
                        type="submit" 
                        class="bg-emerald-800 text-white px-4 py-2 hover:bg-emerald-600"
                    >
                        Update Product
                    </button>
                </div>
            </form>

            <div class="mt-4">
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 text-white px-4 py-2 hover:bg-gray-700">
                    Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
