<x-app-layout>
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Create Category</h1>
        <form method="POST" action="{{ route('admin.categories.create') }}">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium">Category Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full" required>
            </div>
            <div class="mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create</button>
            </div>
        </form>
    </div>
</x-app-layout>
