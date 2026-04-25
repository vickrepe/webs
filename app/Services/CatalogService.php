<?php

namespace App\Services;

use App\Models\CatalogSector;
use App\Models\CatalogVariant;

class CatalogService
{
    /** Todos los sectores con sus variantes (para onboarding). */
    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        return CatalogSector::with('variants')->orderBy('sort_order')->get();
    }

    /**
     * Array en el mismo formato que config('catalog') para mantener
     * compatibilidad con el onboarding view existente.
     */
    public function forOnboarding(): array
    {
        $result = [];
        foreach ($this->all() as $sector) {
            $variants = [];
            foreach ($sector->variants->where('is_active', true) as $v) {
                $variants[$v->key] = [
                    'label'       => $v->label,
                    'color'       => $v->color,
                    'placeholder' => $v->placeholder,
                    'typography'  => $v->typography,
                    'defaults'    => $v->defaults ?? [],
                ];
            }
            $result[$sector->key] = [
                'label'    => $sector->label,
                'icon'     => $sector->icon,
                'template' => $sector->template_key,
                'variants' => $variants,
            ];
        }
        return $result;
    }

    /**
     * Dado el key del sector-catálogo (ej: 'comida') y el key de variante (ej: 'cafeteria'),
     * devuelve el template_key (ej: 'food') y los datos de la variante.
     * Retorna null si no existe.
     */
    public function resolve(string $serviceKey, string $variantKey): ?array
    {
        $sector = $this->all()->firstWhere('key', $serviceKey);
        if (! $sector) return null;

        $variant = $sector->variants->firstWhere('key', $variantKey);
        if (! $variant) return null;

        return [
            'template' => $sector->template_key,
            'variant'  => [
                'label'        => $variant->label,
                'color'        => $variant->color,
                'typography'   => $variant->typography,
                'placeholder'  => $variant->placeholder,
                'defaults'     => $variant->defaults ?? [],
                'theme_colors' => $variant->theme_colors ?? [],
            ],
        ];
    }

    /**
     * Busca variante por template_key + variant key (para SiteService).
     * Ej: template='food', variantKey='cafeteria'
     */
    public function findVariantByTemplate(string $templateKey, string $variantKey): ?array
    {
        $sector = $this->all()->firstWhere('template_key', $templateKey);
        if (! $sector) return null;

        $variant = $sector->variants->firstWhere('key', $variantKey);
        return $variant ? ['typography' => $variant->typography, 'defaults' => $variant->defaults ?? []] : null;
    }

    public function flush(): void
    {
        // no-op — ya no hay caché que limpiar
    }
}
