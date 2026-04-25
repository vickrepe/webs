<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class FullPageController extends Controller
{
    public function show(string $slug, string $sectionType): \Illuminate\View\View
    {
        $site     = Site::where('slug', $slug)->firstOrFail();
        $template = config("templates.{$site->sector}");

        // Solo secciones que tengan show_more habilitado
        abort_unless(
            isset($template['sections'][$sectionType]['section_fields']['show_more']),
            404
        );

        $viewName = "themes.{$site->sector}.pages.{$sectionType}";
        abort_unless(view()->exists($viewName), 404);

        $section   = $site->sections()->where('type', $sectionType)->firstOrFail();
        $config    = $section->config ?? [];
        $homeItems = $config['items']      ?? [];
        $moreItems = $config['more_items'] ?? [];
        $isOwner   = auth()->id() === $site->user_id;

        return view($viewName, compact('site', 'section', 'homeItems', 'moreItems', 'isOwner'));
    }

    public function updateMoreItems(Request $request, string $slug, string $sectionType)
    {
        $site = Site::where('slug', $slug)->firstOrFail();
        abort_if(auth()->id() !== $site->user_id, 403);

        $section = $site->sections()->where('type', $sectionType)->firstOrFail();
        $config  = $section->config ?? [];
        $config['more_items'] = $request->input('more_items', []);
        $section->update(['config' => $config]);

        return response()->json(['ok' => true]);
    }
}
