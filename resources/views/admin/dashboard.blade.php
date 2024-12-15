<x-app-layout>
    <div class="admin-dashboard">
        <div class="container mx-auto">
            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success bg-emerald-200 border border-green-400 text-green-700 px-4 py-3 rounded relative text-center mt-2" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <!-- List of Categories -->
            <h1 class="text-xl text-center font-semibold mt-4">Categories</h1>
            <div>
                <a href="{{ route('admin.categories.create') }}" class="bg-emerald-800 text-white px-4 py-2 p-2 float-left hover:bg-emerald-600 mt-4 mb-4">
                    Add a Category
                </a>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500" style="background-color: #f9f9f9;"> <!-- Custom background color -->
                <thead class="text-xs text-gray-700 uppercase" style="background-color: #e5e7eb;"> <!-- Custom header background -->
                    <tr>
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="border-b" style="background-color: #ffffff;"> <!-- Custom row background -->
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $category->id }}
                            </th>
                            <td class="px-6 py-4">{{ $category->name }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" 
                                   class="text-blue-600 hover:underline m-1">Edit</a>
                                <form method="POST" action="{{ route('admin.categories.delete', $category->id) }}" class="inline m-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Are you sure you want to delete this category?')" 
                                            class="text-red-600 hover:underline">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>        
        </div>
        <!-- List of Products -->
        <div class="container mx-auto">
            <h1 class="text-xl text-center font-semibold mt-4">Products</h1>
            <div>
                <a href="{{ route('admin.products.add-product') }}" class="bg-emerald-800 text-white px-4 py-2 p-2 float-left hover:bg-emerald-600 mb-4">
                    Add a Product
                </a>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500" style="background-color: #f3f4f6;"> <!-- Custom background color -->
                <thead class="text-xs text-gray-700 uppercase" style="background-color: #d1d5db;"> <!-- Custom header background -->
                    <tr>
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Price</th>
                        <th scope="col" class="px-6 py-3">Stock</th>
                        <th scope="col" class="px-6 py-3">Description</th>
                        <th scope="col" class="px-6 py-3">Category ID</th>
                        <th scope="col" class="px-6 py-3">Images</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="border-b" style="background-color: #ffffff;"> <!-- Custom row background -->
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $product->id }}
                            </th>
                            <td class="px-6 py-4">{{ $product->name }}</td>
                            <td class="px-6 py-4">{{ $product->price }}</td>
                            <td class="px-6 py-4">{{ $product->stock }}</td>
                            <td class="px-6 py-4">{{ $product->description }}</td>
                            <td class="px-6 py-4">{{ $product->category_id }}</td>
                            <td class="px-6 py-4">
                                @foreach ($product->multiimages as $image)
                                    <img src="{{ asset('upload/products/' . $image->name) }}" 
                                         alt="Product Image" class="h-16 w-16 object-cover rounded">
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.products.edit', $product->id) }}" 
                                   class="text-blue-600 hover:underline m-1">Edit</a>
                                <form method="POST" action="{{ route('admin.products.delete', $product->id) }}" class="inline m-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Are you sure you want to delete this product?')" 
                                            class="text-red-600 hover:underline">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>           
        </div>
    </div>
</x-app-layout>
