<?php

namespace App\Http\Middleware;

use App\Models\Site;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Picks the site that owns the requested host and shares it with every view.
 */
class ResolveSite
{
    public function handle(Request $request, Closure $next): Response
    {
        $host = strtolower($request->getHost());

        $site = Site::where('domain', $host)->first();

        if (! $site) {
            $known = Site::pluck('domain')->implode(', ');

            abort(404, "No site is configured for host \"{$host}\". Known hosts: {$known}");
        }

        $request->attributes->set('site', $site);
        view()->share('site', $site);

        return $next($request);
    }
}
