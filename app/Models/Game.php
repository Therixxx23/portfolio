<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'thumbnail', 'path', 'iframe_url', 'category', 'status', 'sort_order'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
