@extends('layouts.admin')

@section('title', 'Edit Article')

@section('content')
<div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 md:px-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Article</h1>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded-lg p-6 space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
            <input type="text" name="title" id="title" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" value="{{ $article->title }}">
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">Excerpt</label>
            <textarea name="excerpt" id="excerpt" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">{{ $article->excerpt }}</textarea>
            @error('excerpt') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content</label>
            <textarea name="content" id="content" rows="12" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">{{ $article->content }}</textarea>
            @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
            @if($article->featured_image)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="h-32 w-auto rounded-lg">
                </div>
            @endif
            <input type="file" name="featured_image" id="featured_image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            @error('featured_image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" id="status" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                    <option value="draft" {{ $article->status === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ $article->status === 'published' ? 'selected' : '' }}>Published</option>
                    <option value="archived" {{ $article->status === 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
                @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                <input type="text" name="meta_title" id="meta_title" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" value="{{ $article->meta_title }}">
                @error('meta_title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
            <textarea name="meta_description" id="meta_description" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">{{ $article->meta_description }}</textarea>
            @error('meta_description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg transition">
                <i class="fas fa-save mr-2"></i> Update Article
            </button>
            <a href="{{ route('admin.articles.show', $article) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg transition">
                Cancel
            </a>
        </div>
    </form>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    let articleEditor;

    ClassicEditor
        .create(document.querySelector('#content'))
        .then(editor => {
            articleEditor = editor;
        })
        .catch(error => {
            console.error(error);
        });

    document.querySelector('form')?.addEventListener('submit', () => {
        if (articleEditor) {
            document.querySelector('#content').value = articleEditor.getData();
        }
    });
</script>
@endsection
