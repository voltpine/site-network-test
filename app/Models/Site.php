<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Site extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class)->orderBy('sort');
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Absolute base URL of the site, used for canonical links and the sitemap.
     */
    public function baseUrl(): string
    {
        return rtrim(config('app.url'), '/');
    }
}
