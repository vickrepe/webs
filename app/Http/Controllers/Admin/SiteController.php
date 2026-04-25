<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $sites = Site::with('user')->latest()->paginate(30);
        return view('admin.sites.index', compact('sites'));
    }

    public function show(Site $site)
    {
        return view('admin.sites.show', compact('site'));
    }

    public function updateThemeColors(Request $request, Site $site)
    {
        $config = $site->config ?? [];
        $config['theme_colors'] = $request->input('theme_colors', []);
        $site->update(['config' => $config]);
        return back()->with('success', 'Paleta actualizada.');
    }

    public function updateColors(Request $request, Site $site)
    {
        $config = $site->config ?? [];
        $config['colors'] = array_merge($config['colors'] ?? [], $request->input('colors', []));
        $site->update(['config' => $config]);
        return back()->with('success', 'Colores actualizados.');
    }
}
