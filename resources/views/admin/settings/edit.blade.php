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
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
