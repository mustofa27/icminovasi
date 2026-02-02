<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArticleLike extends Model
{
    protected $table = 'article_likes';

    protected $fillable = [
        'article_id',
        'ip_address',
    ];

    public $timestamps = true;

    /**
     * Get the article that was liked
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
