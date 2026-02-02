<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Client;
use App\Models\Setting;
use App\Models\Article;
use App\Models\Testimonial;
use Illuminate\View\View;

class LandingController extends Controller
{
    /**
     * Display the landing page.
     */
    public function index(): View
    {
        $settings = Setting::first() ?? new Setting(Setting::defaults());

        $featured_projects = Project::where('is_published', true)
            ->where('is_featured', true)
            ->with('client')
            ->latest()
            ->take(6)
            ->get();

        $all_projects = Project::where('is_published', true)
            ->with('client')
            ->latest()
            ->take(3)
            ->get();

        $clients = Client::withCount('projects')
            ->orderBy('projects_count', 'desc')
            ->take(8)
            ->get();

        $testimonials = Testimonial::where('is_published', true)
            ->latest()
            ->take(6)
            ->get();

        $latest_articles = Article::published()
            ->recent()
            ->with('user')
            ->take(3)
            ->get();

        $stats = [
            'total_projects' => Project::where('is_published', true)->count(),
            'completed_projects' => Project::where('is_published', true)->where('status', 'completed')->count(),
            'total_clients' => Client::count(),
            'expertise_areas' => 3,
        ];

        return view('landing', compact('featured_projects', 'all_projects', 'clients', 'testimonials', 'latest_articles', 'stats', 'settings'));
    }

    /**
     * Display project details.
     */
    public function showProject(Project $project): View
    {
        if (!$project->is_published) {
            abort(404);
        }

        $settings = Setting::first() ?? new Setting(Setting::defaults());

        $project->increment('views_count');
        $project->load(['client', 'testimonials']);

        $related_projects = Project::where('is_published', true)
            ->where('area_of_expertise', $project->area_of_expertise)
            ->where('id', '!=', $project->id)
            ->take(3)
            ->get();

        return view('project-detail', compact('project', 'related_projects', 'settings'));
    }
}
