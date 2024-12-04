<x-app-layout>
    <div class="admin-dashboard">
        <h1>Admin Dashboard</h1>
        <p>Welcome!</p>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <!-- List of Categories -->
        <h2>Categories</h2>
        <table class="table-auto border-collapse border border-gray-400 w-full">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">Name</th>
                        <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $category->id }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $category->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                    <a href="{{ route('admin.categories.edit', $category->id) }}" 
                        class="bg-yellow-500 text-black px-4 py-2 rounded">
                            Edit
                    </a>
                    <form method="POST" action="{{ route('admin.categories.delete', $category->id) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                            onclick="return confirm('Are you sure you want to delete this category?')" 
                            class="bg-red-500 text-black px-4 py-2 rounded">
                            Delete
                        </button>
                    </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Link to Add New Category -->
        <div class="mt-4">
            <a href="{{ route('admin.categories.create') }}" class="bg-blue-500 text-black px-4 py-2 rounded">
                Add New Category
            </a>
        </div>        
 
        <!-- List of Products -->
        <h2>Products</h2>
        <table class="table-auto border-collapse border border-gray-400 w-full">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">ID</th>
                    <th class="border border-gray-300 px-4 py-2">Name</th>
                    <th class="border border-gray-300 px-4 py-2">Price</th>
                    <th class="border border-gray-300 px-4 py-2">Stock</th>
                    <th class="border border-gray-300 px-4 py-2">Description</th>
                    <th class="border border-gray-300 px-4 py-2">Category ID</th>
                    <th class="border border-gray-300 px-4 py-2">Images</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $product->id }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $product->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $product->price }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $product->stock }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $product->description }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $product->category_id }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                        @foreach ($product->multiimages as $image )
                            <img src="{{asset('upload/products/'.$image->name)}}">
                        @endforeach
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}" 
                               class="bg-yellow-500 text-black px-4 py-2 rounded">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.products.delete', $product->id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Are you sure you want to delete this product?')" 
                                        class="bg-red-500 text-black px-4 py-2 rounded">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>    
        </table>

        <!-- Link to Add New Product -->
        <div class="mt-4">
            <a href="{{ route('admin.products.add-product') }}" class="bg-blue-500 text-black px-4 py-2 rounded">
                Add New Product
            </a>
        </div>
    </div>
</x-app-layout>
