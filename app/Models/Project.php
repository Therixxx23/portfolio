<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title', 'description', 'thumbnail', 'image_gallery', 'tech_stack', 'category', 'demo_url', 'repo_url', 'external_link', 'link_label', 'sort_order'];

    protected function casts(): array
    {
        return [
            'tech_stack'    => 'array',
            'image_gallery' => 'array',
        ];
    }
}
