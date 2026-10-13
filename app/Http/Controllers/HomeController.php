<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(Request $request): View
    {
        /** @var Site $site */
        $site = $request->attributes->get('site');

        $categories = $site->categories;

        $latest = Article::where('site_id', $site->id)
            ->published()
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->take(6)
            ->get();

        $byCategory = [];
        foreach ($categories as $category) {
            $byCategory[$category->id] = Article::where('site_id', $site->id)
                ->where('category_id', $category->id)
                ->published()
                ->orderByDesc('published_at')
                ->take(3)
                ->get();
        }

        return view('home', compact('categories', 'latest', 'byCategory'));
    }
}
