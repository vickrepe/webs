<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Services\CatalogService;
use App\Services\SiteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OnboardingController extends Controller
{
    public function show(CatalogService $catalog)
    {
        return view('onboarding.index', ['services' => $catalog->forOnboarding()]);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'business_name' => 'required|string|max:80',
            'primary_color' => ['required', 'string', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'logo'          => 'nullable|image|max:2048',
            'service'       => 'required|string',
            'variant'       => 'required|string',
        ]);

        // Resolver sector a partir del servicio seleccionado
        $resolved = app(CatalogService::class)->resolve($data['service'], $data['variant']);
        abort_if(! $resolved, 422, 'Servicio no válido.');

        $sector = $resolved['template'];

        $slug = str($data['business_name'])->slug();

        // Sufijo numérico si el slug ya existe
        if (Site::where('slug', $slug)->exists()) {
            $base    = $slug;
            $counter = 2;
            while (Site::where('slug', "{$base}-{$counter}")->exists()) {
                $counter++;
            }
            $slug = "{$base}-{$counter}";
        }

        $logoUrl = null;
        if ($request->hasFile('logo')) {
            $logoUrl = $request->file('logo')->store('logos', 'public');
        }

        $config = ['colors' => ['primary' => $data['primary_color']]];
        if (! empty($resolved['variant']['theme_colors'])) {
            $config['theme_colors'] = $resolved['variant']['theme_colors'];
        }

        $site = DB::transaction(function () use ($request, $slug, $data, $logoUrl, $sector, $config) {
            $site = app(SiteService::class)->createWithPlaceholders(
                user:    $request->user(),
                slug:    $slug,
                sector:  $sector,
                config:  $config,
                variant: $data['variant'],
            );

            if ($logoUrl) {
                $site->update(['logo_url' => $logoUrl]);

                $aboutSection = $site->sections()->where('type', 'about')->first();
                if ($aboutSection) {
                    $config          = $aboutSection->config ?? [];
                    $config['image'] = '/storage/' . $logoUrl;
                    $aboutSection->update(['config' => $config]);
                }
            }

            return $site;
        });

        $this->injectBusinessName($site, $data['business_name']);

        return redirect()->route('dashboard.builder.show', $site);
    }

    private function injectBusinessName(Site $site, string $businessName): void
    {
        // Actualiza config global del site
        $site->update([
            'config' => array_merge($site->config ?? [], ['business_name' => $businessName]),
        ]);

        // Hero: el headline muestra el nombre real del negocio en lugar del placeholder
        $hero = $site->sections()->where('type', 'hero')->first();
        if ($hero) {
            $hero->update([
                'config' => array_merge($hero->config ?? [], [
                    'headline' => $businessName,
                ]),
            ]);
        }
    }
}
