<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('admin.products.index') }}"
               class="bg-gray-500 text-white px-4 py-2 text-sm hover:bg-gray-400 rounded">
                ← Back
            </a>
        </div>

        <h1 class="text-2xl font-bold mb-6">Create Product</h1>

        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700">Name:</label>
                <input type="text" name="name" class="border rounded w-full px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Category:</label>
                <select name="category_id" class="border rounded w-full px-3 py-2" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Price:</label>
                <input type="number" step="0.01" name="price" class="border rounded w-full px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Cost:</label>
                <input type="number" step="0.01" name="cost" class="border rounded w-full px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Stock:</label>
                <input type="number" name="stock" class="border rounded w-full px-3 py-2" required>
            </div>

            <!-- Image Front -->
            <div class="mb-4">
                <label class="block text-gray-700">Image Front:</label>
                <input type="file" name="image_front" class="border rounded w-full px-3 py-2">
            </div>

            <!-- Image Back -->
            <div class="mb-4">
                <label class="block text-gray-700">Image Back:</label>
                <input type="file" name="image_back" class="border rounded w-full px-3 py-2">
            </div>

            <div class="mb-6">
                <button type="submit" class="bg-black text-white px-4 py-2 text-sm hover:bg-gray-800 rounded">
                    Create
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
