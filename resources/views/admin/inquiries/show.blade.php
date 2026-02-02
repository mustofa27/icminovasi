@extends('layouts.admin')

@section('title', 'Inquiry Detail')

@section('content')
<div class="px-4 py-6 sm:px-0">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Inquiry Detail</h1>
        <a href="{{ route('admin.inquiries.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded">Back</a>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Message</h3>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Name</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $inquiry->name }}</dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">WhatsApp</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $inquiry->whatsapp_number }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $inquiry->email ?? 'N/A' }}</dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Date</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $inquiry->created_at->format('M d, Y H:i') }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Message</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 whitespace-pre-wrap">{{ $inquiry->message }}</dd>
                </div>
            </dl>
        </div>
    </div>

    <div class="bg-white shadow sm:rounded-lg">
        <form action="{{ route('admin.inquiries.update', $inquiry) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            <div class="flex items-center gap-4">
                <label for="status" class="text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="new" {{ $inquiry->status === 'new' ? 'selected' : '' }}>New</option>
                    <option value="replied" {{ $inquiry->status === 'replied' ? 'selected' : '' }}>Replied</option>
                    <option value="archived" {{ $inquiry->status === 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Update Status</button>
            </div>
        </form>
    </div>
</div>
@endsection
