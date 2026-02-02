@extends('layouts.admin')

@section('title', 'Add Client')

@section('content')
<div class="px-4 py-6 sm:px-0">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Add New Client</h1>

    <div class="bg-white shadow sm:rounded-lg">
        <form action="{{ route('admin.clients.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf

            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Client Name *</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name</label>
                    <input type="text" name="company_name" id="company_name" value="{{ old('company_name') }}"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('company_name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('email')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('phone')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="website" class="block text-sm font-medium text-gray-700">Website</label>
                    <input type="url" name="website" id="website" value="{{ old('website') }}"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('website')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <textarea name="address" id="address" rows="3"
                              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ old('address') }}</textarea>
                    @error('address')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="4"
                              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ old('description') }}</textarea>
                    @error('description')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="logo" class="block text-sm font-medium text-gray-700">Logo</label>
                    <input type="file" name="logo" id="logo" accept="image/*"
                           class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    @error('logo')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('admin.clients.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded">
                    Cancel
                </a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Add Client
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
