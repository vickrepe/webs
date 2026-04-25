<?php

namespace Database\Seeders;

use App\Models\CatalogSector;
use App\Models\CatalogVariant;
use Illuminate\Database\Seeder;

class UpdateVariantLayoutsSeeder extends Seeder
{
    public function run(): void
    {
        // ── 1. Layouts en defaults ─────────────────────────────────────────

        // Restaurante y japonés: menú numerado
        $this->mergeDefaultField('comida', 'restaurante', 'menu',     'layout', 'numbered');
        $this->mergeDefaultField('comida', 'japones',     'menu',     'layout', 'numbered');

        // Formal, informal y sport: productos en 4 columnas
        $this->mergeDefaultField('ropa', 'formal',   'products', 'layout', 'cols_4');
        $this->mergeDefaultField('ropa', 'informal', 'products', 'layout', 'cols_4');
        $this->mergeDefaultField('ropa', 'sport',    'products', 'layout', 'cols_4');

        // Mudanza: items de estadísticas
        $this->mergeDefaultField('servicios', 'mudanza', 'stats', 'items', [
            ['number' => '500+', 'label' => 'Mudanzas'],
            ['number' => '12',   'label' => 'Años de experiencia'],
            ['number' => '98%',  'label' => 'Clientes satisfechos'],
            ['number' => '24h',  'label' => 'Respuesta garantizada'],
        ]);

        // ── 2. Hero layout ────────────────────────────────────────────────

        // Split
        $this->mergeDefaultField('comida',    'brunch',    'hero', 'layout', 'split');
        $this->mergeDefaultField('comida',    'panaderia', 'hero', 'layout', 'split');
        $this->mergeDefaultField('comida',    'japones',   'hero', 'layout', 'split');

        // Parallax — imagen dramática fija
        $this->mergeDefaultField('comida',    'restaurante', 'hero', 'layout', 'parallax');

        // Duo — moda / ropa
        $this->mergeDefaultField('ropa',      'formal',      'hero', 'layout', 'duo');
        $this->mergeDefaultField('ropa',      'informal',    'hero', 'layout', 'duo');
        $this->mergeDefaultField('ropa',      'ropa_online', 'hero', 'layout', 'duo');

        // ── 3. Gallery layout ──────────────────────────────────────────────

        $this->mergeDefaultField('comida',    'cafeteria',   'gallery', 'layout', 'bento');
        $this->mergeDefaultField('comida',    'restaurante', 'gallery', 'layout', 'bento');
        $this->mergeDefaultField('comida',    'brunch',      'gallery', 'layout', 'masonry');
        $this->mergeDefaultField('comida',    'italiano',    'gallery', 'layout', 'masonry');
        $this->mergeDefaultField('comida',    'panaderia',   'gallery', 'layout', 'bento');
        $this->mergeDefaultField('comida',    'japones',     'gallery', 'layout', 'masonry');
        $this->mergeDefaultField('servicios', 'carpinteria', 'gallery', 'layout', 'masonry');
        $this->mergeDefaultField('servicios', 'electricista','gallery', 'layout', 'bento');
        $this->mergeDefaultField('ropa',      'formal',      'gallery', 'layout', 'masonry');
        $this->mergeDefaultField('ropa',      'sport',       'gallery', 'layout', 'bento');

        // ── 4. theme_colors faltantes ──────────────────────────────────────

        // Albanilería → mismos colores que carpintería
        $this->setThemeColors('servicios', 'albanileria', [
            'surface'          => '#fcf9f7',
            'surface_low'      => '#f6f3f1',
            'surface_lowest'   => '#ffffff',
            'surface_high'     => '#e5e2e0',
            'on_surface'       => '#2c1f15',
            'on_surface_muted' => '#7a6858',
            'secondary'        => '#5a3a20',
            'tertiary'         => '#7b5030',
            'outline'          => '#dcc1b6',
        ]);

        // Instalador de aires → mismos colores que electricista
        $this->setThemeColors('servicios', 'instalador_aires', [
            'surface'          => '#faf8ff',
            'surface_low'      => '#f3f3fe',
            'surface_lowest'   => '#ffffff',
            'surface_high'     => '#e0e0f8',
            'on_surface'       => '#191b23',
            'on_surface_muted' => '#5a5c70',
            'secondary'        => '#2563eb',
            'tertiary'         => '#943700',
            'outline'          => '#c0c0e0',
        ]);

        // Ropa online → mismos colores que informal
        $this->setThemeColors('ropa', 'ropa_online', [
            'surface'          => '#f6f6f6',
            'surface_low'      => '#f0f1f1',
            'surface_lowest'   => '#ffffff',
            'surface_high'     => '#dbdddd',
            'on_surface'       => '#2d2f2f',
            'on_surface_muted' => '#6b6d6d',
            'secondary'        => '#e1a020',
            'tertiary'         => '#4a3800',
            'outline'          => '#acadad',
        ]);
    }

    private function mergeDefaultField(string $sectorKey, string $variantKey, string $section, string $field, $value): void
    {
        $sector = CatalogSector::where('key', $sectorKey)->first();
        if (! $sector) return;
        $variant = CatalogVariant::where('sector_id', $sector->id)->where('key', $variantKey)->first();
        if (! $variant) return;

        $defaults = $variant->defaults ?? [];
        $defaults[$section][$field] = $value;
        $variant->update(['defaults' => $defaults]);
    }

    private function setThemeColors(string $sectorKey, string $variantKey, array $colors): void
    {
        $sector = CatalogSector::where('key', $sectorKey)->first();
        if (! $sector) return;
        $variant = CatalogVariant::where('sector_id', $sector->id)->where('key', $variantKey)->first();
        if (! $variant) return;
        $variant->update(['theme_colors' => $colors]);
    }
}
