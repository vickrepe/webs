<?php

namespace App\Services;

use App\Models\Site;
use App\Models\User;
use App\Services\CatalogService;

class SiteService
{
    public function createWithPlaceholders(
        User    $user,
        string  $slug,
        string  $sector  = 'barbershop',
        array   $config  = [],
        ?string $variant = null
    ): Site {

        $variantDefaults = null;
        if ($variant) {
            $found = app(CatalogService::class)->findVariantByTemplate($sector, $variant);
            if ($found) {
                $variantDefaults = $found;
            }
        }

        // Inyectar tipografía de la variante en el config del site
        if (! empty($variantDefaults['typography'])) {
            $config = array_replace_recursive(['typography' => $variantDefaults['typography']], $config);
        }

        $site = Site::create([
            'user_id' => $user->id,
            'slug'    => $slug,
            'sector'  => $sector,
            'status'  => 'draft',
            'config'  => array_replace_recursive(
                ['colors' => ['primary' => '#2d2d2d']],
                $config,
                $variant ? ['variant' => $variant] : []
            ),
        ]);

        $order = 0;
        foreach (config("templates.{$sector}.sections") as $type => $schema) {
            $site->sections()->create([
                'type'   => $type,
                'active' => true,
                'order'  => $order++,
                'config' => $this->buildPlaceholderConfig(
                    $schema,
                    $user->plan,
                    $variantDefaults['defaults'][$type] ?? null
                ),
            ]);
        }

        return $site;
    }

    private function buildPlaceholderConfig(array $schema, string $plan, ?array $variantSection = null): array
    {
        if (! empty($schema['repeatable'])) {
            // Variante tiene sus propios items → usarlos; si no, usar placeholder_items del template
            $items = $variantSection['items'] ?? $schema['placeholder_items'] ?? [];
            if (isset($schema['plan_limit'])) {
                $limit = config("plans.{$plan}.{$schema['plan_limit']}", PHP_INT_MAX);
                $items = array_slice($items, 0, $limit);
            }
            $config = ['items' => $items];

            // Copiar section_fields que vengan en los defaults de variante (ej: layout)
            if (!empty($schema['section_fields']) && !empty($variantSection)) {
                foreach ($schema['section_fields'] as $field => $def) {
                    if (isset($variantSection[$field])) {
                        $config[$field] = $variantSection[$field];
                    }
                }
            }

            return $config;
        }

        // Secciones simples: variante puede sobreescribir campo a campo
        $config = [];
        foreach ($schema['fields'] as $field => $def) {
            $config[$field] = $variantSection[$field] ?? $def['placeholder'] ?? '';
        }

        // Copiar section_fields que vengan en los defaults de variante (ej: layout)
        if (!empty($schema['section_fields']) && !empty($variantSection)) {
            foreach ($schema['section_fields'] as $field => $def) {
                if (isset($variantSection[$field])) {
                    $config[$field] = $variantSection[$field];
                }
            }
        }

        return $config;
    }
}
