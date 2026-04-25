<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function show(Request $request, string $slug)
    {
        $site = $request->attributes->get('site');

        $template = config("templates.{$site->sector}");
        $sections = $site->sections()->where('active', true)->get()->keyBy('type');

        $viewName = view()->exists("themes.{$site->sector}.site")
            ? "themes.{$site->sector}.site"
            : 'themes.placeholder';

        return view($viewName, compact('site', 'template', 'sections'));
    }
}
