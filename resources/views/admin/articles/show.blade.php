@extends('layouts.admin')

@section('title', $article->title)

@section('content')
<div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 md:px-8">
    <div class="mb-6 flex justify-between items-start">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $article->title }}</h1>
            <p class="text-gray-600 mt-2">By {{ $article->user->name }} • {{ $article->created_at->format('M d, Y') }}</p>
        </div>
        <div class="space-x-2">
            <a href="{{ route('admin.articles.edit', $article) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition">
                    <i class="fas fa-trash mr-2"></i> Delete
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg p-6 space-y-6">
        <div>
            <span class="px-3 py-1 rounded-full text-sm font-semibold
                @if($article->status === 'published') bg-green-100 text-green-800
                @elseif($article->status === 'draft') bg-yellow-100 text-yellow-800
                @else bg-gray-100 text-gray-800
                @endif">
                {{ ucfirst($article->status) }}
            </span>
            @if($article->published_at)
                <span class="ml-2 text-sm text-gray-600">Published: {{ $article->published_at->format('M d, Y H:i') }}</span>
            @endif
        </div>

        @if($article->featured_image)
            <div>
                <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="max-w-md rounded-lg">
            </div>
        @endif

        <div>
            <h3 class="text-sm font-semibold text-gray-700 mb-2">Excerpt</h3>
            <p class="text-gray-600">{{ $article->excerpt }}</p>
        </div>

        <div>
            <h3 class="text-sm font-semibold text-gray-700 mb-2">Content</h3>
            <div class="prose prose-sm max-w-none text-gray-700 whitespace-pre-wrap">{{ $article->content }}</div>
        </div>

        <div class="grid grid-cols-4 gap-4 pt-6 border-t">
            <div>
                <p class="text-2xl font-bold text-gray-900">{{ $article->views_count }}</p>
                <p class="text-sm text-gray-600">Views</p>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900">{{ $article->likes_count }}</p>
                <p class="text-sm text-gray-600">Likes</p>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900">{{ $article->comments_count }}</p>
                <p class="text-sm text-gray-600">Comments</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Slug</p>
                <p class="text-gray-900 break-all">{{ $article->slug }}</p>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.articles.index') }}" class="text-purple-600 hover:text-purple-800">
            <i class="fas fa-arrow-left mr-2"></i> Back to Articles
        </a>
    </div>
</div>
@endsection
