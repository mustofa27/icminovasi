@extends('layouts.admin')

@section('title', 'Create Testimonial - Admin Panel')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <a href="{{ route('admin.testimonials.index') }}" class="text-purple-600 hover:text-purple-800 flex items-center gap-2 mb-6">
        <i class="fas fa-arrow-left"></i>
        Back to Testimonials
    </a>

    <h1 class="text-3xl font-bold text-gray-900 mb-8">Create New Testimonial</h1>

    @if($errors->any())
    <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-lg p-8">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="project_id" class="block text-sm font-medium text-gray-700 mb-2">Project *</label>
                <select name="project_id" id="project_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                    <option value="">Select a project</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                    @endforeach
                </select>
                @error('project_id')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label for="client_id" class="block text-sm font-medium text-gray-700 mb-2">Client (Optional)</label>
                <select name="client_id" id="client_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <option value="">Select a client</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                    @endforeach
                </select>
                @error('client_id')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="client_name" class="block text-sm font-medium text-gray-700 mb-2">Client Name *</label>
                <input type="text" name="client_name" id="client_name" value="{{ old('client_name') }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                @error('client_name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label for="client_position" class="block text-sm font-medium text-gray-700 mb-2">Client Position</label>
                <input type="text" name="client_position" id="client_position" value="{{ old('client_position') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    placeholder="e.g., CEO, Manager">
                @error('client_position')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="mb-6">
            <label for="testimonial" class="block text-sm font-medium text-gray-700 mb-2">Testimonial *</label>
            <textarea name="testimonial" id="testimonial" rows="6" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">{{ old('testimonial') }}</textarea>
            @error('testimonial')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">Rating (1-5 stars) *</label>
                <select name="rating" id="rating" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                    <option value="">Select rating</option>
                    @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>
                            {{ $i }} Star{{ $i !== 1 ? 's' : '' }}
                        </option>
                    @endfor
                </select>
                @error('rating')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label for="client_photo" class="block text-sm font-medium text-gray-700 mb-2">Client Photo</label>
                <input type="file" name="client_photo" id="client_photo" accept="image/*"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                <p class="text-xs text-gray-500 mt-1">Max file size: 2MB. Supported: JPEG, PNG, JPG, GIF</p>
                @error('client_photo')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="mb-8">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }} class="w-4 h-4">
                <span class="text-sm font-medium text-gray-700">Publish this testimonial</span>
            </label>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-8 py-2 rounded-lg transition font-medium">
                <i class="fas fa-save mr-2"></i>Create Testimonial
            </button>
            <a href="{{ route('admin.testimonials.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-8 py-2 rounded-lg transition font-medium">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
