<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\Project;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TestimonialController extends Controller
{
    /**
     * Display a listing of testimonials.
     */
    public function index(): View
    {
        $testimonials = Testimonial::with(['project', 'client'])
            ->paginate(15);

        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new testimonial.
     */
    public function create(): View
    {
        $projects = Project::where('is_published', true)->orderBy('name')->get();
        $clients = Client::orderBy('name')->get();

        return view('admin.testimonials.create', compact('projects', 'clients'));
    }

    /**
     * Store a newly created testimonial.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'client_id' => 'nullable|exists:clients,id',
            'client_name' => 'required|string|max:255',
            'client_position' => 'nullable|string|max:255',
            'testimonial' => 'required|string',
            'rating' => 'required|integer|between:1,5',
            'client_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('client_photo')) {
            $validated['client_photo'] = $request->file('client_photo')->store('testimonials', 'public');
        }

        $validated['is_published'] = $request->boolean('is_published');

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial created successfully.');
    }

    /**
     * Display the specified testimonial.
     */
    public function show(Testimonial $testimonial): View
    {
        $testimonial->load(['project', 'client']);

        return view('admin.testimonials.show', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified testimonial.
     */
    public function edit(Testimonial $testimonial): View
    {
        $projects = Project::where('is_published', true)->orderBy('name')->get();
        $clients = Client::orderBy('name')->get();

        return view('admin.testimonials.edit', compact('testimonial', 'projects', 'clients'));
    }

    /**
     * Update the specified testimonial.
     */
    public function update(Request $request, Testimonial $testimonial): RedirectResponse
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'client_id' => 'nullable|exists:clients,id',
            'client_name' => 'required|string|max:255',
            'client_position' => 'nullable|string|max:255',
            'testimonial' => 'required|string',
            'rating' => 'required|integer|between:1,5',
            'client_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('client_photo')) {
            // Delete old photo if exists
            if ($testimonial->client_photo) {
                \Storage::disk('public')->delete($testimonial->client_photo);
            }
            $validated['client_photo'] = $request->file('client_photo')->store('testimonials', 'public');
        }

        $validated['is_published'] = $request->boolean('is_published');

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial updated successfully.');
    }

    /**
     * Remove the specified testimonial.
     */
    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        // Delete photo if exists
        if ($testimonial->client_photo) {
            \Storage::disk('public')->delete($testimonial->client_photo);
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial deleted successfully.');
    }
}
