<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard.
     */
    public function index(): View
    {
        $stats = [
            'total_projects' => \App\Models\Project::count(),
            'active_projects' => \App\Models\Project::where('status', 'ongoing')->count(),
            'completed_projects' => \App\Models\Project::where('status', 'completed')->count(),
            'total_clients' => \App\Models\Client::count(),
            'featured_projects' => \App\Models\Project::where('is_featured', true)->count(),
            'total_testimonials' => \App\Models\Testimonial::count(),
        ];

        $recent_projects = \App\Models\Project::with('client')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_projects'));
    }
}
