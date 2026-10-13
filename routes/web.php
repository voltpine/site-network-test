<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RobotsController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
Route::get('/robots.txt', RobotsController::class)->name('robots');

// The "play" section was renamed to "google-play" in September; keep old links alive.
Route::redirect('/play/{slug}', '/google-play/{slug}');

Route::get('/{category}', CategoryController::class)
    ->where('category', '[a-z0-9-]+')
    ->name('category');

Route::get('/{category}/{slug}', ArticleController::class)
    ->where(['category' => '[a-z0-9-]+', 'slug' => '[a-z0-9-]+'])
    ->name('article');
