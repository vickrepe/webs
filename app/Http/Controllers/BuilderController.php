<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class BuilderController extends Controller
{
    public function show(Site $site)
    {
        $this->authorize('view', $site);

        $template   = config("templates.{$site->sector}");
        $sections   = $site->sections()->orderBy('order')->get()->keyBy('type');
        $planLimits = config("plans.{$site->user->plan}");

        return view('builder.index', compact('site', 'template', 'sections', 'planLimits'));
    }

    public function updateColors(Request $request, Site $site)
    {
        $this->authorize('update', $site);

        $request->validate([
            'primary'   => ['required', 'string', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'secondary' => ['nullable', 'string', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ]);

        $config = $site->config ?? [];
        $config['colors']['primary'] = $request->primary;
        if ($request->filled('secondary')) {
            $config['colors']['secondary'] = $request->secondary;
        }
        $site->update(['config' => $config]);

        return response()->json(['ok' => true, 'text_on_primary' => $site->fresh()->textOnPrimary()]);
    }

    public function uploadLogo(Request $request, Site $site)
    {
        $this->authorize('update', $site);

        $request->validate(['logo' => 'required|image|max:2048']);

        $path = $request->file('logo')->store('logos', 'public');

        $site->update(['logo_url' => $path]);

        return response()->json([
            'ok'  => true,
            'url' => asset('storage/' . $path),
        ]);
    }

    public function toggleSection(Request $request, Site $site, string $type)
    {
        $this->authorize('update', $site);

        $maxOrder = $site->sections()->max('order') ?? 0;
        $section  = $site->sections()->firstOrCreate(
            ['type' => $type],
            ['active' => true, 'order' => $maxOrder + 1, 'config' => []]
        );

        if (! $section->canBeDeactivated()) {
            return response()->json(['error' => 'Esta sección no puede desactivarse.'], 422);
        }

        $section->update(['active' => $request->boolean('active')]);

        return response()->json(['ok' => true, 'active' => $section->active]);
    }

    public function updateSection(Request $request, Site $site, string $type)
    {
        $this->authorize('update', $site);

        $config = $request->input('config', []);

        // Server-side plan limit enforcement
        $schema = config("templates.{$site->sector}.sections.{$type}");
        if (isset($schema['plan_limit'])) {
            $limitKey = $schema['plan_limit'];
            $items    = $config['items'] ?? [];
            if ($site->atLimit($limitKey, count($items))) {
                return response()->json([
                    'error' => 'Límite del plan alcanzado para ' . $limitKey,
                ], 422);
            }
        }

        $section = $site->sections()->firstOrCreate(
            ['type' => $type],
            ['order' => $site->sections()->count(), 'active' => true]
        );

        $section->update(['config' => $config]);

        return response()->json(['ok' => true, 'section' => $section]);
    }

    public function uploadImage(Request $request, Site $site)
    {
        $this->authorize('update', $site);

        $request->validate(['image' => 'required|image|max:4096']);

        $path = $request->file('image')->store('sections/' . $site->id, 'public');

        return response()->json(['url' => '/storage/' . $path]);
    }

    public function updateTypography(Request $request, Site $site)
    {
        $this->authorize('update', $site);

        $request->validate([
            'heading' => ['required', 'string', 'max:60'],
            'body'    => ['required', 'string', 'max:60'],
        ]);

        $config = $site->config ?? [];
        $config['typography']['heading'] = $request->heading;
        $config['typography']['body']    = $request->body;
        $site->update(['config' => $config]);

        return response()->json(['ok' => true]);
    }

    public function publish(Site $site)
    {
        $this->authorize('update', $site);

        $site->update(['status' => 'published']);

        return response()->json(['ok' => true, 'url' => url("/site/{$site->slug}")]);
    }
}
