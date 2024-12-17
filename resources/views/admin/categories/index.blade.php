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
                <a href="{{ route('categories.create') }}" class="bg-emerald-800 text-white px-4 py-2 p-2 float-left hover:bg-emerald-600 mt-4 mb-4">
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
                                <a href="{{ route('categories.edit', $category->id) }}" 
                                   class="text-blue-600 hover:underline m-1">Edit</a>
                                <form method="POST" action="{{ route('categories.destroy', $category->id) }}" class="inline m-1">
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
            </main>
        </div>
    </div>
</x-app-layout>
