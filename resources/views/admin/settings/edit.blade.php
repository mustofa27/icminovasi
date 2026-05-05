@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
<div class="px-4 py-6 sm:px-0">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">General Settings</h1>

    <div class="bg-white shadow sm:rounded-lg">
        <form action="{{ route('admin.settings.update') }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="message_template" class="block text-sm font-medium text-gray-700">Message Template</label>
                    <textarea name="message_template" id="message_template" rows="4"
                              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ old('message_template', $settings->message_template) }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Used for WhatsApp and email body.</p>
                    @error('message_template')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="whatsapp_number" class="block text-sm font-medium text-gray-700">WhatsApp Number</label>
                    <input type="text" name="whatsapp_number" id="whatsapp_number" value="{{ old('whatsapp_number', $settings->whatsapp_number) }}"
                           placeholder="6281234567890"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <p class="text-xs text-gray-500 mt-1">Use international format without + or spaces.</p>
                    @error('whatsapp_number')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="email_destination" class="block text-sm font-medium text-gray-700">Email Destination</label>
                    <input type="email" name="email_destination" id="email_destination" value="{{ old('email_destination', $settings->email_destination) }}"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('email_destination')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <h2 class="text-xl font-semibold text-gray-900">Social Media Links</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label for="social_links[facebook]" class="block text-sm font-medium text-gray-700">Facebook</label>
                            <input type="url" name="social_links[facebook]" id="social_links[facebook]" value="{{ old('social_links.facebook', $settings->social_links['facebook'] ?? '') }}"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label for="social_links[instagram]" class="block text-sm font-medium text-gray-700">Instagram</label>
                            <input type="url" name="social_links[instagram]" id="social_links[instagram]" value="{{ old('social_links.instagram', $settings->social_links['instagram'] ?? '') }}"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label for="social_links[twitter]" class="block text-sm font-medium text-gray-700">Twitter/X</label>
                            <input type="url" name="social_links[twitter]" id="social_links[twitter]" value="{{ old('social_links.twitter', $settings->social_links['twitter'] ?? '') }}"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label for="social_links[linkedin]" class="block text-sm font-medium text-gray-700">LinkedIn</label>
                            <input type="url" name="social_links[linkedin]" id="social_links[linkedin]" value="{{ old('social_links.linkedin', $settings->social_links['linkedin'] ?? '') }}"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label for="social_links[youtube]" class="block text-sm font-medium text-gray-700">YouTube</label>
                            <input type="url" name="social_links[youtube]" id="social_links[youtube]" value="{{ old('social_links.youtube', $settings->social_links['youtube'] ?? '') }}"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-900">Products</h2>
                        <button type="button" id="add-product" class="bg-indigo-100 text-indigo-700 hover:bg-indigo-200 text-sm font-medium py-2 px-3 rounded">Add Product</button>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Manage product cards shown on the homepage Products section.</p>

                    @php($products = old('products', $settings->products ?? \App\Models\Setting::defaults()['products']))
                    <div id="products-wrapper" class="mt-4 space-y-4">
                        @foreach($products as $index => $product)
                            <div class="product-item border border-gray-200 rounded-lg p-4 bg-gray-50">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Product Name</label>
                                        <input type="text" name="products[{{ $index }}][name]" value="{{ $product['name'] ?? '' }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Product URL</label>
                                        <input type="url" name="products[{{ $index }}][url]" value="{{ $product['url'] ?? '' }}" placeholder="https://example.com" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Category</label>
                                        <input type="text" name="products[{{ $index }}][category]" value="{{ $product['category'] ?? '' }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Status</label>
                                        <input type="text" name="products[{{ $index }}][status]" value="{{ $product['status'] ?? '' }}" placeholder="Available" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Font Awesome Icon</label>
                                        <input type="text" name="products[{{ $index }}][icon]" value="{{ $product['icon'] ?? '' }}" placeholder="fa-satellite-dish" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700">Description</label>
                                        <textarea name="products[{{ $index }}][description]" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ $product['description'] ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="mt-3 text-right">
                                    <button type="button" class="remove-product text-red-600 hover:text-red-800 text-sm font-medium">Remove</button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @error('products')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    @error('products.*.name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    @error('products.*.url')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    @error('products.*.description')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    @error('products.*.category')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    @error('products.*.status')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    @error('products.*.icon')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    (function () {
        const productsWrapper = document.getElementById('products-wrapper');
        const addButton = document.getElementById('add-product');

        if (!productsWrapper || !addButton) {
            return;
        }

        const createProductItem = (index) => {
            const wrapper = document.createElement('div');
            wrapper.className = 'product-item border border-gray-200 rounded-lg p-4 bg-gray-50';
            wrapper.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Product Name</label>
                        <input type="text" name="products[${index}][name]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Product URL</label>
                        <input type="url" name="products[${index}][url]" placeholder="https://example.com" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Category</label>
                        <input type="text" name="products[${index}][category]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <input type="text" name="products[${index}][status]" value="Available" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Font Awesome Icon</label>
                        <input type="text" name="products[${index}][icon]" value="fa-cube" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="products[${index}][description]" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>
                </div>
                <div class="mt-3 text-right">
                    <button type="button" class="remove-product text-red-600 hover:text-red-800 text-sm font-medium">Remove</button>
                </div>
            `;

            return wrapper;
        };

        addButton.addEventListener('click', () => {
            const index = productsWrapper.querySelectorAll('.product-item').length;
            productsWrapper.appendChild(createProductItem(index));
        });

        productsWrapper.addEventListener('click', (event) => {
            if (!event.target.classList.contains('remove-product')) {
                return;
            }

            const item = event.target.closest('.product-item');
            if (item) {
                item.remove();
            }
        });
    })();
</script>
@endsection
