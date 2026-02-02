<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of projects.
     */
    public function index(): View
    {
        $projects = Project::with('client')
            ->latest()
            ->paginate(15);

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create(): View
    {
        $clients = Client::orderBy('name')->get();
        return view('admin.projects.create', compact('clients'));
    }

    /**
     * Store a newly created project.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:projects,slug',
            'short_description' => 'required|string|max:255',
            'description' => 'required|string',
            'client_id' => 'required|exists:clients,id',
            'area_of_expertise' => 'required|in:informatics,creative,mechatronics',
            'technologies_used' => 'nullable|array',
            'project_value' => 'nullable|numeric|min:0',
            'team_size' => 'nullable|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:ongoing,completed,on-hold,cancelled',
            'featured_image' => 'nullable|image|max:2048',
            'video_url' => 'nullable|url',
            'live_url' => 'nullable|url',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'challenges' => 'nullable|string',
            'solutions' => 'nullable|string',
            'results' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Handle file upload
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('projects', 'public');
        }

        Project::create($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified project.
     */
    public function show(Project $project): View
    {
        $project->load(['client', 'testimonials']);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(Project $project): View
    {
        $clients = Client::orderBy('name')->get();
        return view('admin.projects.edit', compact('project', 'clients'));
    }

    /**
     * Update the specified project.
     */
    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:projects,slug,' . $project->id,
            'short_description' => 'required|string|max:255',
            'description' => 'required|string',
            'client_id' => 'required|exists:clients,id',
            'area_of_expertise' => 'required|in:informatics,creative,mechatronics',
            'technologies_used' => 'nullable|array',
            'project_value' => 'nullable|numeric|min:0',
            'team_size' => 'nullable|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:ongoing,completed,on-hold,cancelled',
            'featured_image' => 'nullable|image|max:2048',
            'video_url' => 'nullable|url',
            'live_url' => 'nullable|url',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'challenges' => 'nullable|string',
            'solutions' => 'nullable|string',
            'results' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Handle file upload
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('projects', 'public');
        }

        $project->update($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified project.
     */
    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}
