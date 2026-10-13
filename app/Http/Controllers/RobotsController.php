<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RobotsController extends Controller
{
    public function __invoke(Request $request): Response
    {
        /** @var Site $site */
        $site = $request->attributes->get('site');

        $lines = [
            'User-agent: *',
            'Disallow: /t/*/list/',
            'Allow: /',
            '',
            'Sitemap: '.$site->baseUrl().'/sitemap.xml',
            '',
        ];

        return response(implode("\n", $lines))->header('Content-Type', 'text/plain; charset=UTF-8');
    }
}
