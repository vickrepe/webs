<?php

namespace App\Http\Middleware;

use App\Models\Site;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResolveTenant
{
    public function handle(Request $request, Closure $next): Response
    {
        $site = null;

        if (app()->environment('local')) {
            $slug = $request->route('slug');
            $site = Site::where('slug', $slug)->firstOrFail();
        } else {
            $host = $request->getHost();
            $slug = str_replace('.vibly.com', '', $host);

            $site = Site::where('custom_domain', $host)->first()
                ?? Site::where('slug', $slug)->firstOrFail();
        }

        $request->attributes->set('site', $site);

        return $next($request);
    }
}
