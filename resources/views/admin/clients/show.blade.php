@extends('layouts.admin')

@section('title', $client->name)

@section('content')
<div class="px-4 py-6 sm:px-0">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">{{ $client->name }}</h1>
        <div class="space-x-3">
            <a href="{{ route('admin.clients.edit', $client) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                Edit Client
            </a>
            <a href="{{ route('admin.clients.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded">
                Back to List
            </a>
        </div>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Client Information</h3>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                @if($client->logo)
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Logo</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}" class="h-20 w-auto">
                    </dd>
                </div>
                @endif
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Company Name</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $client->company_name ?? 'N/A' }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $client->email ?? 'N/A' }}</dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Phone</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $client->phone ?? 'N/A' }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Website</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        @if($client->website)
                            <a href="{{ $client->website }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">{{ $client->website }}</a>
                        @else
                            N/A
                        @endif
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Address</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $client->address ?? 'N/A' }}</dd>
                </div>
                @if($client->description)
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Description</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $client->description }}</dd>
                </div>
                @endif
            </dl>
        </div>
    </div>

    <!-- Projects -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Projects ({{ $client->projects->count() }})</h3>
        </div>
        <div class="border-t border-gray-200">
            @if($client->projects->count() > 0)
                <ul class="divide-y divide-gray-200">
                    @foreach($client->projects as $project)
                        <li class="px-4 py-4 hover:bg-gray-50">
                            <a href="{{ route('admin.projects.show', $project) }}" class="block">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-medium text-indigo-600">{{ $project->name }}</p>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($project->status === 'ongoing') bg-green-100 text-green-800
                                        @elseif($project->status === 'completed') bg-blue-100 text-blue-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst($project->status) }}
                                    </span>
                                </div>
                                <p class="mt-1 text-sm text-gray-500">{!! $project->short_description !!}</p>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="px-4 py-6 text-center text-gray-500">
                    No projects for this client yet.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
