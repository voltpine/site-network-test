<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __invoke(Request $request, string $category): View
    {
        /** @var Site $site */
        $site = $request->attributes->get('site');

        $category = Category::where('site_id', $site->id)
            ->where('slug', $category)
            ->firstOrFail();

        $articles = Article::where('category_id', $category->id)
            ->published()
            ->orderByDesc('published_at')
            ->get();

        return view('category', compact('category', 'articles'));
    }
}
