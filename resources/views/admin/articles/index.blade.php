@extends('layouts.admin')

@section('title', 'Blog Articles')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 md:px-8">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Blog Articles</h1>
        <a href="{{ route('admin.articles.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg transition">
            <i class="fas fa-plus mr-2"></i> New Article
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Author</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Views</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Comments</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Published</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($articles as $article)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.articles.show', $article) }}" class="text-purple-600 hover:text-purple-800">
                                {{ $article->title }}
                            </a>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $article->user->name }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                @if($article->status === 'published') bg-green-100 text-green-800
                                @elseif($article->status === 'draft') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($article->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $article->views_count }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $article->comments_count }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $article->published_at ? $article->published_at->format('M d, Y') : '—' }}
                        </td>
                        <td class="px-6 py-4 text-sm space-x-2">
                            <a href="{{ route('admin.articles.edit', $article) }}" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
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
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            No articles yet. <a href="{{ route('admin.articles.create') }}" class="text-purple-600 hover:text-purple-800">Create one</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $articles->links() }}
    </div>
</div>
@endsection
