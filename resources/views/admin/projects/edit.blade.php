@extends('layouts.admin')

@section('title', 'Edit Project')

@section('content')
<div class="px-4 py-6 sm:px-0">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Project: {{ $project->name }}</h1>

    <div class="bg-white shadow sm:rounded-lg">
        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Project Name *</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $project->name) }}" required
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <!-- Slug -->
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $project->slug) }}"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('slug')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <!-- Short Description -->
                <div>
                    <label for="short_description" class="block text-sm font-medium text-gray-700">Short Description *</label>
                    <input type="text" name="short_description" id="short_description" value="{{ old('short_description', $project->short_description) }}" required
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('short_description')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Full Description *</label>
                    <textarea name="description" id="description" rows="5"
                              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $project->description) }}</textarea>
                    @error('description')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <!-- Client -->
                <div>
                    <label for="client_id" class="block text-sm font-medium text-gray-700">Client *</label>
                    <select name="client_id" id="client_id" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Select a client</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id', $project->client_id) == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('client_id')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <!-- Area of Expertise -->
                <div>
                    <label for="area_of_expertise" class="block text-sm font-medium text-gray-700">Area of Expertise *</label>
                    <select name="area_of_expertise" id="area_of_expertise" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Select area</option>
                        <option value="informatics" {{ old('area_of_expertise', $project->area_of_expertise) === 'informatics' ? 'selected' : '' }}>Informatics</option>
                        <option value="creative" {{ old('area_of_expertise', $project->area_of_expertise) === 'creative' ? 'selected' : '' }}>Creative</option>
                        <option value="mechatronics" {{ old('area_of_expertise', $project->area_of_expertise) === 'mechatronics' ? 'selected' : '' }}>Mechatronics</option>
                    </select>
                    @error('area_of_expertise')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                    <select name="status" id="status" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="ongoing" {{ old('status', $project->status) === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="completed" {{ old('status', $project->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="on-hold" {{ old('status', $project->status) === 'on-hold' ? 'selected' : '' }}>On Hold</option>
                        <option value="cancelled" {{ old('status', $project->status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <!-- Dates -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date *</label>
                        <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $project->start_date?->format('Y-m-d')) }}" required
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        @error('start_date')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $project->end_date?->format('Y-m-d')) }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        @error('end_date')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>
                </div>

                <!-- Featured Image -->
                <div>
                    <label for="featured_image" class="block text-sm font-medium text-gray-700">Featured Image</label>
                    @if($project->featured_image)
                        <div class="mt-2 mb-2">
                            <img src="{{ asset('storage/' . $project->featured_image) }}" alt="{{ $project->name }}" class="h-32 w-auto">
                        </div>
                    @endif
                    <input type="file" name="featured_image" id="featured_image" accept="image/*"
                           class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    @error('featured_image')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <!-- Checkboxes -->
                <div class="flex items-center space-x-6">
                    <div class="flex items-center">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="is_featured" class="ml-2 block text-sm text-gray-900">Featured Project</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $project->is_published) ? 'checked' : '' }}
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="is_published" class="ml-2 block text-sm text-gray-900">Publish</label>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('admin.projects.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded">
                    Cancel
                </a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Update Project
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    let projectEditor;

    ClassicEditor
        .create(document.querySelector('#description'))
        .then(editor => {
            projectEditor = editor;
        })
        .catch(error => {
            console.error(error);
        });

    document.querySelector('form')?.addEventListener('submit', () => {
        if (projectEditor) {
            document.querySelector('#description').value = projectEditor.getData();
        }
    });
</script>
@endsection
