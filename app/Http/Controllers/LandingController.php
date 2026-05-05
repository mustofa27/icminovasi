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

        $publishedProjects = Project::where('is_published', true)->get(['area_of_expertise']);

        $stats = [
            'total_projects' => $publishedProjects->count(),
            'completed_projects' => Project::where('is_published', true)->where('status', 'completed')->count(),
            'total_clients' => Client::count(),
            'expertise_areas' => $publishedProjects
                ->pluck('expertise_areas')
                ->flatten()
                ->unique()
                ->count(),
        ];

        return view('landing', compact('featured_projects', 'all_projects', 'clients', 'testimonials', 'latest_articles', 'stats', 'settings'));
    }

    /**
     * Display all projects.
     */
    public function allProjects(): View
    {
        $projects = Project::where('is_published', true)
            ->with('client')
            ->latest()
            ->paginate(12);
        $settings = Setting::first() ?? new Setting(Setting::defaults());

        return view('projects.index', compact('projects', 'settings'));
    }

    /**
     * Display all clients.
     */
    public function allClients(): View
    {
        $clients = Client::withCount('projects')
            ->orderBy('projects_count', 'desc')
            ->paginate(16);
        $settings = Setting::first() ?? new Setting(Setting::defaults());

        return view('clients.index', compact('clients', 'settings'));
    }

    /**
     * Display all testimonials.
     */
    public function allTestimonials(): View
    {
        $testimonials = Testimonial::where('is_published', true)
            ->latest()
            ->paginate(12);
        $settings = Setting::first() ?? new Setting(Setting::defaults());

        return view('testimonials.index', compact('testimonials', 'settings'));
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

        $projectExpertise = $project->expertise_areas;

        $related_projects = Project::where('is_published', true)
            ->where('id', '!=', $project->id)
            ->when(!empty($projectExpertise), function ($query) use ($projectExpertise) {
                $query->where(function ($expertiseQuery) use ($projectExpertise) {
                    foreach ($projectExpertise as $expertise) {
                        $expertiseQuery->orWhereJsonContains('area_of_expertise', $expertise);
                    }
                });
            })
            ->take(3)
            ->get();

        return view('project-detail', compact('project', 'related_projects', 'settings'));
    }
}
