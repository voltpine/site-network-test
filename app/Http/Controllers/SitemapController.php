<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(Request $request): Response
    {
        /** @var Site $site */
        $site = $request->attributes->get('site');

        $base = $site->baseUrl();
        $now = now()->toAtomString();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
        $xml .= "  <url><loc>{$base}/</loc><lastmod>{$now}</lastmod></url>\n";

        foreach ($site->categories as $category) {
            $xml .= "  <url><loc>{$base}{$category->path()}</loc><lastmod>{$now}</lastmod></url>\n";
        }

        foreach (Article::where('site_id', $site->id)->orderByDesc('published_at')->get() as $article) {
            $xml .= "  <url><loc>{$base}{$article->path()}</loc><lastmod>{$now}</lastmod></url>\n";
        }

        $xml .= '</urlset>';

        return response($xml);
    }
}
