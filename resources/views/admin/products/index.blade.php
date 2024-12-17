<x-app-layout>
    <div class="bg-gray-100 min-h-screen">

        <!-- Main Content -->
        <div class="container mx-auto flex flex-col lg:flex-row gap-6 mt-8 min-h-screen">
            <!-- Sidebar -->
            <aside class="bg-white p-6 shadow-md w-full lg:w-1/4 h-auto lg:h-full lg:sticky top-0">
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
                <div class="container mx-auto">
                    <h1 class="text-xl text-center font-semibold mt-4">Products</h1>
                    <div>
                        <a href="{{ route('products.create') }}" class="bg-emerald-800 text-white px-4 py-2 p-2 float-left hover:bg-emerald-600 mb-4">
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
                                <th scope="col" class="px-6 py-3">Category Name</th>
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
                                    <td class="px-6 py-4">{{ $product->category->name }}</td>
                                    <td class="px-6 py-4">
                                        @foreach ($product->multiimages as $image)
                                            <img src="{{ asset('upload/products/' . $image->name) }}" 
                                                alt="Product Image" class="h-16 w-16 object-cover rounded">
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('products.edit', $product->id) }}" 
                                        class="text-blue-600 hover:underline m-1">Edit</a>
                                        <form method="POST" action="{{ route('products.destroy', $product->id) }}" class="inline m-1">
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
            </main>
        </div>
    </div>
</x-app-layout>
