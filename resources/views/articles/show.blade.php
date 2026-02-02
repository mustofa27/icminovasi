@extends('layouts.blog')

@section('title', $article->title . ' - ICM Inovasi Indonesia')
@section('meta_description', $article->meta_description ?? Str::limit($article->content, 150))

@section('content')
<article class="bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('articles.index') }}" class="text-purple-600 hover:text-purple-800 mb-4 inline-block">
                <i class="fas fa-arrow-left mr-2"></i> Back to Blog
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            @if($article->featured_image)
                <div class="h-96 overflow-hidden">
                    <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                </div>
            @endif

            <div class="p-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $article->title }}</h1>

                <div class="flex items-center gap-4 text-gray-600 mb-8 pb-8 border-b">
                    <span>By <strong>{{ $article->user->name }}</strong></span>
                    <span>•</span>
                    <span>{{ $article->published_at->format('M d, Y') }}</span>
                    <span>•</span>
                    <span><i class="fas fa-eye mr-1"></i> {{ $article->views_count }} views</span>
                </div>

                <div class="prose prose-lg max-w-none text-gray-700 mb-8">
                    {!! $article->content !!}
                </div>

                <div class="flex items-center gap-4 py-8 border-t border-b">
                    <button class="like-btn flex items-center gap-2 px-4 py-2 rounded-lg transition
                        @if($liked) bg-red-100 text-red-600 hover:bg-red-200
                        @else bg-gray-100 text-gray-600 hover:bg-gray-200
                        @endif"
                        data-like-url="{{ route('articles.like', $article) }}"
                        onclick="toggleLike(this)">
                        <i class="fas fa-heart"></i>
                        <span class="likes-count">{{ $article->likes_count }}</span>
                    </button>
                    <span class="text-gray-600"><i class="fas fa-comment mr-2"></i> {{ $article->comments_count }} comments</span>
                </div>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Comments ({{ $article->comments_count }})</h2>

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Display Approved Comments -->
            @if($comments->count() > 0)
                <div class="space-y-6 mb-12">
                    @foreach($comments as $comment)
                        <div class="bg-white rounded-lg p-6 border-l-4 border-purple-600">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-semibold text-gray-900">{{ $comment->name }}</h3>
                                <span class="text-sm text-gray-500">{{ $comment->approved_at->format('M d, Y H:i') }}</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">{{ $comment->email }}</p>
                            <p class="text-gray-700 whitespace-pre-wrap">{{ $comment->content }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="mb-12">
                    {{ $comments->links() }}
                </div>
            @else
                <p class="text-gray-500 mb-8">No approved comments yet. Be the first to comment!</p>
            @endif

            <!-- Comment Form -->
            <div class="bg-white rounded-lg p-8 border-2 border-purple-200">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Leave a Comment</h3>

                @if($errors->has('comment'))
                    <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-4">
                        <ul>
                            @foreach($errors->get('comment') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('comments.store', $article) }}" method="POST" class="space-y-4">
                    @csrf

                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                            <input type="text" name="name" id="name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" value="{{ old('name') }}">
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" id="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" value="{{ old('email') }}">
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Comment</label>
                        <textarea name="content" id="content" rows="5" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 resize-none" placeholder="Share your thoughts...">{{ old('content') }}</textarea>
                        @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg transition font-medium">
                        <i class="fas fa-paper-plane mr-2"></i> Post Comment
                    </button>
                </form>

                <p class="text-sm text-gray-500 mt-4 text-center">Your comment will be reviewed before appearing</p>
            </div>
        </div>
    </div>
</article>

<script>
function toggleLike(button) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    const likeUrl = button.getAttribute('data-like-url');
    
    if (!csrfToken) {
        alert('Session expired. Please refresh the page.');
        return;
    }
    
    const formData = new FormData();
    formData.append('_token', csrfToken.content);
    
    fetch(likeUrl, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken.content,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Unable to process your request');
        }
        return response.json();
    })
    .then(data => {
        const likesCount = button.querySelector('.likes-count');
        
        likesCount.textContent = data.likes_count;
        
        if (data.liked) {
            button.classList.remove('bg-gray-100', 'text-gray-600', 'hover:bg-gray-200');
            button.classList.add('bg-red-100', 'text-red-600', 'hover:bg-red-200');
        } else {
            button.classList.remove('bg-red-100', 'text-red-600', 'hover:bg-red-200');
            button.classList.add('bg-gray-100', 'text-gray-600', 'hover:bg-gray-200');
        }
    })
    .catch(error => {
        console.error('Like error:', error);
        alert('Unable to like this article. Please try again later.');
    });
}
</script>
@endsection
