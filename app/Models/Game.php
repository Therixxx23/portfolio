<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'thumbnail', 'path', 'category', 'status', 'sort_order'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
