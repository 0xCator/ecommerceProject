<!-- resources/views/admin/store-category.blade.php -->
<x-app-layout>
    <div class="container mx-auto mt-5">
        <h1 class="text-2xl font-bold mb-4">Category Saved Successfully</h1>
        <p>The category <strong>{{ $category->name }}</strong> has been created!</p>

        <div class="mt-4">
            <a href="{{ route('admin.create-category') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                Create Another Category
            </a>
            <a href="{{ route('admin.dashboard') }}" class="bg-green-500 text-white px-4 py-2 rounded">
                Back to Dashboard
            </a>
        </div>
    </div>
</x-app-layout>
