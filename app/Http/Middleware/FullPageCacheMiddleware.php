<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FullPageCacheMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $key = __METHOD__.'::'.sha1($request->fullUrl());

        if (Cache::has($key)) {
            return response(Cache::get($key));
        }

        $response = $next($request);

        // Only cache successful GET requests with text-based content
        if ($request->isMethod('GET') && $response->isSuccessful() && str_contains($response->headers->get('Content-Type'), 'text')) {
            Cache::put($key, $response->getContent(), now()->addMinutes(60)); // Cache for 60 minutes
        }

        return $response;
    }
}
