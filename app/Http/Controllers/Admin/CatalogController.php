<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CatalogSector;
use App\Models\CatalogVariant;
use App\Services\CatalogService;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function __construct(private CatalogService $catalog) {}

    public function index()
    {
        $sectors   = CatalogSector::with('variants')->orderBy('sort_order')->get();
        $templates = array_keys(config('templates', []));
        return view('admin.catalog.index', compact('sectors', 'templates'));
    }

    public function storeSector(Request $request)
    {
        $data = $request->validate([
            'key'          => 'required|string|unique:catalog_sectors,key',
            'label'        => 'required|string|max:80',
            'icon'         => 'required|string|max:10',
            'template_key' => 'required|string',
        ]);
        $data['sort_order'] = CatalogSector::max('sort_order') + 1;
        CatalogSector::create($data);
        $this->catalog->flush();
        return back()->with('success', 'Sector creado.');
    }

    public function showSector(CatalogSector $sector)
    {
        $sector->load('variants');
        $templates = array_keys(config('templates', []));
        return view('admin.catalog.sector', compact('sector', 'templates'));
    }

    public function storeVariant(Request $request, CatalogSector $sector)
    {
        $data = $request->validate([
            'key'                => "required|string|unique:catalog_variants,key,NULL,id,sector_id,{$sector->id}",
            'label'              => 'required|string|max:80',
            'color'              => ['required', 'string', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'placeholder'        => 'nullable|string|max:120',
            'typography'         => 'required|array',
            'typography.heading' => 'required|string',
            'typography.body'    => 'required|string',
        ]);

        $data['sector_id']  = $sector->id;
        $data['defaults']   = null;
        $data['sort_order'] = $sector->variants()->max('sort_order') + 1;

        CatalogVariant::create($data);
        $this->catalog->flush();
        return back()->with('success', 'Variante creada.');
    }

    public function updateVariant(Request $request, CatalogSector $sector, CatalogVariant $variant)
    {
        $data = $request->validate([
            'label'              => 'required|string|max:80',
            'color'              => ['required', 'string', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'placeholder'        => 'nullable|string|max:120',
            'typography'         => 'required|array',
            'typography.heading' => 'required|string',
            'typography.body'    => 'required|string',
            'is_active'          => 'boolean',
        ]);

        $data['theme_colors'] = $request->input('theme_colors', []);
        $variant->update($data);
        $this->catalog->flush();
        return back()->with('success', 'Variante actualizada.');
    }

    public function destroyVariant(CatalogSector $sector, CatalogVariant $variant)
    {
        $variant->delete();
        $this->catalog->flush();
        return back()->with('success', 'Variante eliminada.');
    }

    public function editDefaults(CatalogSector $sector, CatalogVariant $variant)
    {
        $template = config("templates.{$sector->template_key}");
        abort_if(! $template, 404);
        return view('admin.catalog.defaults', compact('sector', 'variant', 'template'));
    }

    public function updateDefaults(Request $request, CatalogSector $sector, CatalogVariant $variant)
    {
        $variant->update(['defaults' => $request->input('defaults', [])]);
        $this->catalog->flush();
        return back()->with('success', 'Contenido por defecto guardado.');
    }

    public function uploadDefaultImage(Request $request, CatalogSector $sector, CatalogVariant $variant)
    {
        $request->validate(['image' => 'required|image|max:4096']);
        $path = $request->file('image')->store(
            "images/defaults/{$sector->key}/{$variant->key}", 'public'
        );
        return response()->json(['url' => '/storage/' . $path]);
    }

    public function destroySector(CatalogSector $sector)
    {
        $hasSites = \App\Models\Site::where('sector', $sector->template_key)->exists();
        if ($hasSites) {
            return back()->withErrors(['sector' => 'No se puede borrar: hay webs con este sector.']);
        }
        $sector->delete();
        $this->catalog->flush();
        return back()->with('success', 'Sector eliminado.');
    }
}
