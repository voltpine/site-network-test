<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Every page URL on the network ends with a slash, so send the bare form
 * to its canonical twin before routing happens.
 */
class TrailingSlash
{
    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->getPathInfo();

        if ($path !== '/' && ! str_ends_with($path, '/') && ! str_contains(basename($path), '.')) {
            $query = $request->getQueryString();

            return redirect()->away($request->getSchemeAndHttpHost().$path.'/'.($query ? '?'.$query : ''));
        }

        return $next($request);
    }
}
