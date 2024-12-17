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

            <!-- Products Section -->
            <main class="flex-1">
            <div class="container mx-auto flex justify-center items-start min-h-screen mt-8">
                <div class="w-1/2">
                    <h1 class="text-2xl font-bold mb-4 text-center">Add New Product</h1>

                    @if($errors->any())
                    <div class="alert alert-danger text-center mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm">Product Name</label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                value="{{ old('name') }}" 
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
                                value="{{ old('price') }}" 
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
                                value="{{ old('stock') }}" 
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
                            >{{ old('description') }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="category_id" class="block text-sm">Category</label>
                            <select 
                                name="category_id" 
                                id="category_id" 
                                class="mt-1 block w-full border-gray-300 shadow-sm focus:border-emerald-400 focus:ring focus:ring-emerald-800 focus:ring-opacity-30" 
                                required
                            >
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="image" class="block text-sm">Product Images</label>
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
                                Create Product
                            </button>
                        </div>
                    </form>

                    <div class="mt-4">
                        <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-4 py-2 hover:bg-gray-700">
                            Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
            </main>
        </div>
    </div>
</x-app-layout>
