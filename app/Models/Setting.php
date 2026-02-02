<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'message_template',
        'whatsapp_number',
        'email_destination',
        'social_links',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];

    public static function defaults(): array
    {
        return [
            'message_template' => 'Hello I am interested to use your service for my project',
            'whatsapp_number' => '6281279881542',
            'email_destination' => 'icminovasi@gmail.com',
            'social_links' => [
                'facebook' => null,
                'instagram' => null,
                'twitter' => null,
                'linkedin' => null,
                'youtube' => null,
            ],
        ];
    }
}
