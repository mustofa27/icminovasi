<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    public const EXPERTISE_OPTIONS = ['informatics', 'creative', 'mechatronics'];

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
        'area_of_expertise' => 'array',
        'technologies_used' => 'array',
        'gallery_images' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'project_value' => 'decimal:2',
    ];

    public function getExpertiseAreasAttribute(): array
    {
        $areas = $this->area_of_expertise;

        if (is_array($areas)) {
            return array_values(array_filter($areas));
        }

        if (is_string($areas) && $areas !== '') {
            return [$areas];
        }

        return [];
    }

    public function getPrimaryExpertiseAttribute(): ?string
    {
        return $this->expertise_areas[0] ?? null;
    }

    public static function expertiseLabel(string $expertise): string
    {
        return ucfirst($expertise);
    }

    public static function expertiseBadgeClass(string $expertise): string
    {
        return match ($expertise) {
            'informatics' => 'bg-blue-100 text-blue-800',
            'creative' => 'bg-pink-100 text-pink-800',
            default => 'bg-orange-100 text-orange-800',
        };
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class);
    }
}
