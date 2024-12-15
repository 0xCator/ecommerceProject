<x-app-layout>
    <div class="container mx-auto flex justify-center items-start min-h-screen mt-8">
        <div class="w-1/2">
            <h1 class="text-2xl font-bold mb-4 text-center">New Category</h1>
            <form method="POST" action="{{ route('admin.categories.create') }}">
                @csrf
                <div>
                    <label for="name" class="block text-sm">Category Name</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 shadow-sm focus:border-emerald-400 focus:ring focus:ring-emerald-800 focus:ring-opacity-30" required>
                </div>
                <div class="mt-4">
                    <button type="submit" class="bg-emerald-800 text-white px-4 py-2 hover:bg-emerald-600">Create</button>
                </div>
            </form>
            <div class="mt-4">
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 text-white px-4 py-2 hover:bg-gray-700 text-center">
                    Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
