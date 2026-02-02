@extends('layouts.blog')

@section('title', 'Blog - ICM Inovasi Indonesia')
@section('meta_description', 'Read our latest articles about informatics, creative, and mechatronics innovations')

@section('content')
<div class="bg-gradient-to-br from-purple-600 to-pink-600 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl sm:text-5xl font-bold mb-4">Blog</h1>
        <p class="text-purple-100 text-lg">Latest articles and insights from our team</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if($articles->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($articles as $article)
                <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition hover-scale group">
                    @if($article->featured_image)
                        <div class="h-48 overflow-hidden bg-gray-200">
                            <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                        </div>
                    @else
                        <div class="h-48 bg-gradient-to-br from-purple-400 to-pink-400 flex items-center justify-center">
                            <i class="fas fa-newspaper text-white text-4xl"></i>
                        </div>
                    @endif
                    
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-sm text-gray-500">{{ $article->published_at->format('M d, Y') }}</span>
                            <span class="text-sm text-gray-500">•</span>
                            <span class="text-sm text-gray-500">{{ $article->user->name }}</span>
                        </div>
                        
                        <a href="{{ route('articles.show', $article) }}">
                            <h3 class="text-xl font-bold mb-2 group-hover:text-purple-600 transition">{{ $article->title }}</h3>
                        </a>
                        
                        <p class="text-gray-600 text-sm mb-4">{{ $article->excerpt ?? Str::limit($article->content, 100) }}</p>
                        
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <div class="flex gap-4">
                                <span><i class="fas fa-eye mr-1"></i> {{ $article->views_count }}</span>
                                <span><i class="fas fa-heart mr-1"></i> {{ $article->likes_count }}</span>
                                <span><i class="fas fa-comment mr-1"></i> {{ $article->comments_count }}</span>
                            </div>
                        </div>
                        
                        <a href="{{ route('articles.show', $article) }}" class="inline-block mt-4 text-purple-600 hover:text-purple-800 font-semibold">
                            Read More <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $articles->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <i class="fas fa-newspaper text-gray-400 text-5xl mb-4"></i>
            <p class="text-gray-500 text-lg">No articles published yet</p>
        </div>
    @endif
</div>
@endsection
