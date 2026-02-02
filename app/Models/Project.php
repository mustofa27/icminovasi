<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'client_id',
        'area_of_expertise',
        'technologies_used',
        'project_value',
        'team_size',
        'start_date',
        'end_date',
        'duration_months',
        'status',
        'featured_image',
        'gallery_images',
        'video_url',
        'live_url',
        'case_study_pdf',
        'is_featured',
        'display_order',
        'challenges',
        'solutions',
        'results',
        'is_published',
        'views_count',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'technologies_used' => 'array',
        'gallery_images' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'project_value' => 'decimal:2',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class);
    }
}
