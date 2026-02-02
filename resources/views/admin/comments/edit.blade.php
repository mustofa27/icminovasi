@extends('layouts.admin')

@section('title', 'Edit Comment')

@section('content')
<div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 md:px-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Comment</h1>

    <div class="bg-white shadow rounded-lg p-6 space-y-6">
        <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
            <p class="text-sm text-gray-600 mb-1"><strong>Article:</strong> {{ $comment->article->title }}</p>
            <p class="text-sm text-gray-600"><strong>Submitted by:</strong> {{ $comment->name }} ({{ $comment->email }})</p>
        </div>

        <div>
            <h3 class="font-semibold text-gray-900 mb-2">Comment Content</h3>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <p class="text-gray-700 whitespace-pre-wrap">{{ $comment->content }}</p>
            </div>
        </div>

        <form action="{{ route('admin.comments.update', $comment) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" id="status" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                    <option value="pending" {{ $comment->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ $comment->status === 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ $comment->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
                @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Comment (You can edit if needed)</label>
                <textarea name="content" id="content" rows="6" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">{{ $comment->content }}</textarea>
                @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg transition">
                    <i class="fas fa-save mr-2"></i> Update Comment
                </button>
                <a href="{{ route('admin.comments.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
