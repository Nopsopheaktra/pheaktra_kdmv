<x-app-layout>
    <div class="min-h-screen bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Back Link -->
            <div class="mb-12">
                <a href="{{ route('products.index') }}" class="text-gray-500 hover:text-black text-sm font-light tracking-wide transition-colors">
                    ← BACK TO PRODUCTS
                </a>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-50 text-green-800 px-6 py-4 mb-8 text-sm font-light">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Product Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-24 lg:gap-40">
                <!-- Product Images Section -->
                <div class="space-y-6 mr-8 lg:mr-12">
                    <!-- Main Image Display -->
                    <div class="w-full max-w-[70%] mx-auto aspect-square bg-gray-50" style="max-width: 70%;">
                        @if ($product->image_front || $product->image_back)
                            <img id="main-image"
                                 src="{{ asset('storage/products/' . ($product->image_front ?: $product->image_back)) }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-cover cursor-zoom-in" style="width: 100%; height: 100%;">
                        @else
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                <span class="text-gray-400 font-light">No Image Available</span>
                            </div>
                        @endif
                    </div>

                    <!-- Thumbnail Gallery -->
                    @if ($product->image_front || $product->image_back)
                        <div class="flex justify-center space-x-4">
                            @if ($product->image_front)
                                <div class="thumbnail-container cursor-pointer border-2 border-transparent hover:border-gray-300 transition-colors active-thumbnail"
                                     data-image="{{ asset('storage/products/' . $product->image_front) }}"
                                     data-alt="{{ $product->name }} - Front">
                                    <img src="{{ asset('storage/products/' . $product->image_front) }}"
                                         alt="{{ $product->name }} - Front"
                                         class="w-20 h-20 object-cover">
                                </div>
                            @endif
                            @if ($product->image_back)
                                <div class="thumbnail-container cursor-pointer border-2 border-transparent hover:border-gray-300 transition-colors"
                                     data-image="{{ asset('storage/products/' . $product->image_back) }}"
                                     data-alt="{{ $product->name }} - Back">
                                    <img src="{{ asset('storage/products/' . $product->image_back) }}"
                                         alt="{{ $product->name }} - Back"
                                         class="w-20 h-20 object-cover">
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Product Information Section -->
                <div class="mt-12 lg:pl-16">
                    <div class="lg:sticky lg:top-24">
                        <!-- Product Title -->
                        <h1 class="text-4xl lg:text-5xl font-light text-black mb-8 tracking-tight">
                            {{ $product->name }}
                        </h1>

                        <!-- Price -->
                        <div class="mb-12">
                            <p class="text-2xl font-light text-black">
                                ${{ number_format($product->price, 2) }}
                            </p>
                        </div>

                        <!-- Product Description Area -->
                        <div class="mb-12 text-gray-600 font-light leading-relaxed">
                            <p>Premium quality product crafted with attention to detail.</p>
                            <p class="mt-2">Available for immediate shipping.</p>
                        </div>

                        <!-- Stock Status -->
                        <div class="mb-8">
                            @if($product->stock > 0)
                                <p class="text-sm text-green-600 font-light">
                                    In Stock ({{ $product->stock }} available)
                                </p>
                            @else
                                <p class="text-sm text-red-600 font-light">
                                    Out of Stock
                                </p>
                            @endif
                        </div>

                        <!-- Add to Cart Form -->
                        <form id="add-to-cart-form" action="{{ route('cart.add', $product) }}" method="POST" class="space-y-6">
                            @csrf

                            <!-- Quantity Selector -->
                            <div class="flex items-center space-x-4">
                                <label for="quantity" class="text-sm font-light text-gray-700">Quantity:</label>
                                <select name="quantity" id="quantity" class="border border-gray-300 px-3 py-2 text-sm font-light focus:outline-none focus:border-black appearance-none bg-white">
                                    @for($i = 1; $i <= min(10, $product->stock); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Total Price Display -->
                            <div class="text-sm font-light text-black">
                                Total: $<span id="total-price">{{ number_format($product->price, 2) }}</span>
                            </div>
                            <input type="hidden" name="total_price" id="total-price-input" value="{{ $product->price }}">

                            <!-- Add to Cart Button -->
                            <button type="submit"
                                    @if($product->stock <= 0) disabled @endif
                                    class="w-full bg-black text-white py-4 text-sm font-light tracking-widest hover:bg-gray-900 transition-colors duration-200 disabled:bg-gray-300 disabled:cursor-not-allowed">
                                @if($product->stock > 0)
                                    ADD TO CART
                                @else
                                    SOLD OUT
                                @endif
                            </button>
                        </form>

                        <!-- Additional Info -->
                        <div class="mt-12 pt-8 border-t border-gray-200 space-y-4">
                            <div class="flex justify-between text-sm font-light">
                                <span class="text-gray-600">Shipping:</span>
                                <span class="text-black">Calculated at checkout</span>
                            </div>
                            <div class="flex justify-between text-sm font-light">
                                <span class="text-gray-600">Category:</span>
                                <span class="text-black">{{ $product->category->name ?? 'General' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Quantity Multiplication and Image Gallery -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Quantity calculation functionality
            const quantitySelect = document.getElementById('quantity');
            const totalPriceSpan = document.getElementById('total-price');
            const totalPriceInput = document.getElementById('total-price-input');
            const price = {{ $product->price }};

            if (quantitySelect) {
                quantitySelect.addEventListener('change', function () {
                    const quantity = parseInt(this.value);
                    const total = (price * quantity).toFixed(2);
                    totalPriceSpan.textContent = total;
                    totalPriceInput.value = total;
                });
            }

            // Image gallery functionality
            const mainImage = document.getElementById('main-image');
            const thumbnails = document.querySelectorAll('.thumbnail-container');

            thumbnails.forEach(thumbnail => {
                thumbnail.addEventListener('click', function () {
                    // Remove active class from all thumbnails
                    thumbnails.forEach(t => t.classList.remove('active-thumbnail'));

                    // Add active class to clicked thumbnail
                    this.classList.add('active-thumbnail');

                    // Update main image
                    const newImageSrc = this.getAttribute('data-image');
                    const newImageAlt = this.getAttribute('data-alt');

                    if (mainImage) {
                        mainImage.src = newImageSrc;
                        mainImage.alt = newImageAlt;
                    }
                });
            });
        });
    </script>

    <!-- Inline CSS for Dropdown Styling and Thumbnail Gallery -->
    <style>
        select.appearance-none {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: none;
            padding-right: 1.5rem;
        }
        select.appearance-none::-ms-expand {
            display: none;
        }

        .thumbnail-container {
            overflow: hidden;
            border-radius: 4px;
        }

        .thumbnail-container.active-thumbnail {
            border-color: #000 !important;
            border-width: 2px;
        }

        .thumbnail-container img {
            transition: transform 0.2s ease;
        }

        .thumbnail-container:hover img {
            transform: scale(1.05);
        }
    </style>
</x-app-layout>
