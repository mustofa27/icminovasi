@extends('layouts.admin')

@section('title', 'Manage Comments')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 md:px-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Comments Management</h1>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Article</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Author</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Comment</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($comments as $comment)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <a href="{{ route('articles.show', $comment->article) }}" class="text-purple-600 hover:text-purple-800 text-sm">
                                {{ $comment->article->title }}
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $comment->name }}</div>
                            <div class="text-sm text-gray-600">{{ $comment->email }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-600 line-clamp-2">{{ $comment->content }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                @if($comment->status === 'approved') bg-green-100 text-green-800
                                @elseif($comment->status === 'pending') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($comment->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $comment->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 text-sm space-x-2">
                            <a href="{{ route('admin.comments.edit', $comment) }}" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            No comments yet
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $comments->links() }}
    </div>
</div>
@endsection
