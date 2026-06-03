<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title', 'description', 'thumbnail', 'tech_stack', 'category', 'demo_url', 'repo_url', 'sort_order'];

    protected function casts(): array
    {
        return [
            'tech_stack' => 'array',
        ];
    }
}
