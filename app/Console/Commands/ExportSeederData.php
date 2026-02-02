<?php

namespace App\Console\Commands;

use App\Models\Client;
use App\Models\Project;
use App\Models\Testimonial;
use Illuminate\Console\Command;

class ExportSeederData extends Command
{
    protected $signature = 'export:seeder-data';
    protected $description = 'Export existing database data to seeder format';

    public function handle()
    {
        $this->info('Exporting Clients...');
        $this->exportClients();

        $this->info("\nExporting Projects...");
        $this->exportProjects();

        $this->info("\nExporting Testimonials...");
        $this->exportTestimonials();
    }

    protected function exportClients()
    {
        $clients = Client::all();
        
        if ($clients->isEmpty()) {
            $this->warn('No clients found');
            return;
        }

        $this->line("\n// Clients Data:");
        foreach ($clients as $client) {
            $this->line("Client::create([");
            $this->line("    'name' => '" . addslashes($client->name) . "',");
            $this->line("    'company_name' => '" . addslashes($client->company_name ?? '') . "',");
            $this->line("    'email' => '" . addslashes($client->email ?? '') . "',");
            $this->line("    'phone' => '" . addslashes($client->phone ?? '') . "',");
            $this->line("    'website' => '" . addslashes($client->website ?? '') . "',");
            $this->line("    'description' => '" . addslashes($client->description ?? '') . "',");
            $this->line("]);");
            $this->line("");
        }
    }

    protected function exportProjects()
    {
        $projects = Project::all();
        
        if ($projects->isEmpty()) {
            $this->warn('No projects found');
            return;
        }

        $this->line("\n// Projects Data:");
        foreach ($projects as $project) {
            $this->line("Project::create([");
            $this->line("    'name' => '" . addslashes($project->name) . "',");
            $this->line("    'slug' => '" . addslashes($project->slug) . "',");
            $this->line("    'short_description' => '" . addslashes($project->short_description) . "',");
            $this->line("    'description' => '" . addslashes($project->description) . "',");
            $this->line("    'challenges' => '" . addslashes($project->challenges ?? '') . "',");
            $this->line("    'solutions' => '" . addslashes($project->solutions ?? '') . "',");
            $this->line("    'results' => '" . addslashes($project->results ?? '') . "',");
            $this->line("    'area_of_expertise' => '" . addslashes($project->area_of_expertise) . "',");
            $this->line("    'status' => '" . addslashes($project->status) . "',");
            $this->line("    'team_size' => " . ($project->team_size ?? 'null') . ",");
            $this->line("    'start_date' => '" . ($project->start_date?->format('Y-m-d') ?? '') . "',");
            $this->line("    'end_date' => '" . ($project->end_date?->format('Y-m-d') ?? '') . "',");
            $this->line("    'technologies_used' => " . json_encode($project->technologies_used ?? []) . ",");
            $this->line("    'is_featured' => " . ($project->is_featured ? 'true' : 'false') . ",");
            $this->line("    'is_published' => " . ($project->is_published ? 'true' : 'false') . ",");
            $this->line("    'seo_title' => '" . addslashes($project->seo_title ?? '') . "',");
            $this->line("    'seo_description' => '" . addslashes($project->seo_description ?? '') . "',");
            $this->line("    'client_id' => " . ($project->client_id ?? 'null') . ",");
            $this->line("]);");
            $this->line("");
        }
    }

    protected function exportTestimonials()
    {
        $testimonials = Testimonial::all();
        
        if ($testimonials->isEmpty()) {
            $this->warn('No testimonials found');
            return;
        }

        $this->line("\n// Testimonials Data:");
        foreach ($testimonials as $testimonial) {
            $this->line("Testimonial::create([");
            $this->line("    'project_id' => " . ($project->id ?? 'null') . ",");
            $this->line("    'client_id' => " . ($testimonial->client_id ?? 'null') . ",");
            $this->line("    'client_name' => '" . addslashes($testimonial->client_name) . "',");
            $this->line("    'client_position' => '" . addslashes($testimonial->client_position ?? '') . "',");
            $this->line("    'testimonial' => '" . addslashes($testimonial->testimonial) . "',");
            $this->line("    'rating' => " . ($testimonial->rating ?? 5) . ",");
            $this->line("    'is_published' => " . ($testimonial->is_published ? 'true' : 'false') . ",");
            $this->line("]);");
            $this->line("");
        }
    }
}
