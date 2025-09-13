<x-app-layout>
    <div class="min-h-screen bg-white py-8 px-4">
        <div class="max-w-2xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-2xl font-light text-gray-900 mb-2">Edit Product</h1>
                <a href="{{ route('admin.products.index') }}" class="text-gray-600 hover:text-gray-900 text-sm">
                    ← Back to Products
                </a>
            </div>

            <!-- Form -->
            <form action="{{ route('admin.products.update', $product) }}" method="POST"
                class="bg-white border border-gray-100 p-6" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm text-gray-700 mb-1">Product Name</label>
                        <input type="text" name="name" value="{{ $product->name }}" required class="w-full border border-gray-300 p-2">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-700 mb-1">Price</label>
                        <input type="number" step="0.01" name="price" value="{{ $product->price }}" required class="w-full border border-gray-300 p-2">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-700 mb-1">Cost</label>
                        <input type="number" step="0.01" name="cost" value="{{ $product->cost }}" required class="w-full border border-gray-300 p-2">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-700 mb-1">Stock</label>
                        <input type="number" name="stock" value="{{ $product->stock }}" required class="w-full border border-gray-300 p-2">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-700 mb-1">Category</label>
                        <select name="category_id" class="w-full border border-gray-300 p-2">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Current Images -->
                    <div class="flex gap-4 mt-4">
                        @if ($product->image_front)
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Front</p>
                                <img src="{{ asset('storage/products/' . $product->image_front) }}" class="w-32 h-32 object-cover border">
                            </div>
                        @endif
                        @if ($product->image_back)
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Back</p>
                                <img src="{{ asset('storage/products/' . $product->image_back) }}" class="w-32 h-32 object-cover border">
                            </div>
                        @endif
                    </div>

                    <!-- Upload New Images -->
                    <div class="mb-4 mt-4">
                        <label class="block text-gray-700">Replace Image Front:</label>
                        <input type="file" name="image_front" class="border rounded w-full px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Replace Image Back:</label>
                        <input type="file" name="image_back" class="border rounded w-full px-3 py-2">
                    </div>
                </div>

                <button type="submit" class="bg-black text-white px-6 py-2 text-sm mt-6 hover:bg-gray-800">
                    Update Product
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
