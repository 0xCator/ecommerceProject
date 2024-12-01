<x-app-layout>
    <div class="admin-dashboard">
        <h1>Admin Dashboard</h1>
        <p>Welcome, Admin!</p>

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
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $category->id }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $category->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Link to Create Category -->
        <div class="mt-4">
            <a href="{{ route('admin.createCategory') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                Create New Category
            </a>
        </div>
    </div>
</x-app-layout>
