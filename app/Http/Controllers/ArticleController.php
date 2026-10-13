<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function __invoke(Request $request, string $category, string $slug): View
    {
        /** @var Site $site */
        $site = $request->attributes->get('site');

        $category = Category::where('site_id', $site->id)
            ->where('slug', $category)
            ->firstOrFail();

        $article = Article::where('category_id', $category->id)
            ->where('slug', $slug)
            ->published()
            ->first();

        if (! $article) {
            // Keep the visitor on the site instead of showing a bare error page.
            return view('article-missing', compact('category'));
        }

        $related = Article::where('category_id', $category->id)
            ->published()
            ->where('id', '!=', $article->id)
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        return view('article', compact('category', 'article', 'related'));
    }
}
