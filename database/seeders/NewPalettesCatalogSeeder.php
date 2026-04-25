<?php

namespace Database\Seeders;

use App\Models\CatalogSector;
use App\Models\CatalogVariant;
use Illuminate\Database\Seeder;

class NewPalettesCatalogSeeder extends Seeder
{
    public function run(): void
    {
        // ── 1. Comida — 4 variantes nuevas ───────────────────────────────────
        $comida = CatalogSector::where('key', 'comida')->first();
        if ($comida) {
            foreach ($this->foodVariants() as $key => $data) {
                CatalogVariant::updateOrCreate(
                    ['sector_id' => $comida->id, 'key' => $key], $data
                );
            }
        }

        // ── 2. Servicios — 5 variantes nuevas ────────────────────────────────
        $servicios = CatalogSector::where('key', 'servicios')->first();
        if ($servicios) {
            foreach ($this->serviciosVariants() as $key => $data) {
                CatalogVariant::updateOrCreate(
                    ['sector_id' => $servicios->id, 'key' => $key], $data
                );
            }
        }

        // ── 3. Ropa — 3 variantes nuevas ─────────────────────────────────────
        $ropa = CatalogSector::where('key', 'ropa')->first();
        if ($ropa) {
            foreach ($this->ropaVariants() as $key => $data) {
                CatalogVariant::updateOrCreate(
                    ['sector_id' => $ropa->id, 'key' => $key], $data
                );
            }
        }

        // ── 4. Nuevo sector: Influencer ───────────────────────────────────────
        $influencer = CatalogSector::updateOrCreate(
            ['key' => 'influencer'],
            ['label' => 'Influencer / Creator', 'icon' => '📸', 'template_key' => 'influencer', 'sort_order' => 10]
        );
        CatalogVariant::updateOrCreate(
            ['sector_id' => $influencer->id, 'key' => 'atelier_noir'],
            [
                'label'       => 'Editorial Luxe',
                'color'       => '#625d5b',
                'placeholder' => 'Ej: @sofia.editorial',
                'typography'  => ['heading' => 'Playfair Display', 'body' => 'Inter'],
                'is_active'   => true,
                'sort_order'  => 0,
                'theme_colors' => [
                    'surface'          => '#f9f9fb',
                    'surface_low'      => '#f2f4f7',
                    'surface_lowest'   => '#ffffff',
                    'surface_high'     => '#e8eaee',
                    'on_surface'       => '#2d3338',
                    'on_surface_muted' => '#6b7278',
                    'secondary'        => '#625d5b',
                    'tertiary'         => '#6f5d37',
                    'outline'          => '#d0d4d8',
                    'outline_variant'  => '#c8ccd0',
                    'radius_button'    => '4px',
                    'radius_card'      => '4px',
                    'glass_opacity'    => '0.85',
                    'glass_blur'       => '20px',
                ],
                'defaults' => [
                    'hero' => ['subheadline' => 'Contenido, estilo y autenticidad', 'cta_text' => 'Ver mi trabajo'],
                ],
            ]
        );
    }

    private function foodVariants(): array
    {
        return [
            'brunch' => [
                'label'       => 'Brunch',
                'color'       => '#006948',
                'placeholder' => 'Ej: Melbourne Brunch Co.',
                'typography'  => ['heading' => 'Plus Jakarta Sans', 'body' => 'Be Vietnam Pro'],
                'is_active'   => true,
                'sort_order'  => 10,
                'theme_colors' => [
                    'surface'          => '#f0fdf4',
                    'surface_low'      => '#eaf7ee',
                    'surface_lowest'   => '#ffffff',
                    'surface_high'     => '#deebe3',
                    'on_surface'       => '#131e19',
                    'on_surface_muted' => '#4a6055',
                    'secondary'        => '#006948',
                    'tertiary'         => '#4a9d6f',
                    'outline'          => '#bccac0',
                    'outline_variant'  => '#bccac0',
                    'radius_button'    => '999px',
                    'radius_card'      => '24px',
                    'glass_opacity'    => '0.70',
                    'glass_blur'       => '20px',
                ],
                'defaults' => [
                    'hero' => ['subheadline' => 'Brunch con alma, café con carácter', 'cta_text' => 'Ver carta'],
                    'menu' => ['items' => [
                        ['name' => 'Avocado toast',   'price' => '9€',  'description' => 'Pan artesano, aguacate y huevo poché',     'image' => ''],
                        ['name' => 'Pancakes stack',  'price' => '11€', 'description' => 'Tortitas con sirope de arce y frutos rojos', 'image' => ''],
                        ['name' => 'Brunch completo', 'price' => '16€', 'description' => 'Selección completa con café incluido',      'image' => ''],
                    ]],
                ],
            ],

            'italiano' => [
                'label'       => 'Italiano',
                'color'       => '#B70011',
                'placeholder' => 'Ej: Trattoria Passione',
                'typography'  => ['heading' => 'Raleway', 'body' => 'Plus Jakarta Sans'],
                'is_active'   => true,
                'sort_order'  => 11,
                'theme_colors' => [
                    'surface'          => '#FFF8F1',
                    'surface_low'      => '#F9F2E9',
                    'surface_lowest'   => '#FFFFFF',
                    'surface_high'     => '#EDE0D0',
                    'on_surface'       => '#1E1B17',
                    'on_surface_muted' => '#6B5B47',
                    'secondary'        => '#5A632E',
                    'tertiary'         => '#8B5E3C',
                    'outline'          => '#D4C4B0',
                    'outline_variant'  => '#C8B49A',
                    'radius_button'    => '8px',
                    'radius_card'      => '12px',
                    'glass_opacity'    => '0.80',
                    'glass_blur'       => '16px',
                ],
                'defaults' => [
                    'hero' => ['subheadline' => 'Cocina italiana con alma y tradición', 'cta_text' => 'Ver carta'],
                    'menu' => ['items' => [
                        ['name' => 'Pasta al ragù',    'price' => '13€', 'description' => 'Pasta fresca con ragù de res y parmesano',       'image' => ''],
                        ['name' => 'Pizza Margherita', 'price' => '11€', 'description' => 'Tomate San Marzano, mozzarella fior di latte',   'image' => ''],
                        ['name' => 'Tiramisú',         'price' => '6€',  'description' => 'Receta clásica con mascarpone y café',           'image' => ''],
                    ]],
                ],
            ],

            'japones' => [
                'label'       => 'Japonés',
                'color'       => '#565e74',
                'placeholder' => 'Ej: Restaurante Zen',
                'typography'  => ['heading' => 'Montserrat', 'body' => 'Inter'],
                'is_active'   => true,
                'sort_order'  => 12,
                'theme_colors' => [
                    'surface'          => '#f7f9fb',
                    'surface_low'      => '#f0f4f7',
                    'surface_lowest'   => '#ffffff',
                    'surface_high'     => '#dde3e8',
                    'on_surface'       => '#2a3439',
                    'on_surface_muted' => '#6b7a83',
                    'secondary'        => '#565e74',
                    'tertiary'         => '#c0392b',
                    'outline'          => '#a9b4b9',
                    'outline_variant'  => '#a9b4b9',
                    'radius_button'    => '0px',
                    'radius_card'      => '0px',
                    'glass_opacity'    => '0.80',
                    'glass_blur'       => '20px',
                ],
                'defaults' => [
                    'hero' => ['subheadline' => 'Precisión y sabor en cada bocado', 'cta_text' => 'Ver menú'],
                    'menu' => ['items' => [
                        ['name' => 'Sashimi selección',  'price' => '18€', 'description' => 'Selección del chef, piezas del día',        'image' => ''],
                        ['name' => 'Ramen tradicional',  'price' => '14€', 'description' => 'Caldo de 12 horas, chashu y huevo marinado', 'image' => ''],
                        ['name' => 'Gyoza casera',       'price' => '9€',  'description' => '6 piezas al vapor o a la plancha',          'image' => ''],
                    ]],
                ],
            ],

            'panaderia' => [
                'label'       => 'Panadería',
                'color'       => '#8d4b00',
                'placeholder' => 'Ej: Panadería El Horno',
                'typography'  => ['heading' => 'Plus Jakarta Sans', 'body' => 'Be Vietnam Pro'],
                'is_active'   => true,
                'sort_order'  => 13,
                'theme_colors' => [
                    'surface'          => '#fdf9e9',
                    'surface_low'      => '#f8f3d8',
                    'surface_lowest'   => '#ffffff',
                    'surface_high'     => '#ede4c8',
                    'on_surface'       => '#2d1f00',
                    'on_surface_muted' => '#7a5c2a',
                    'secondary'        => '#c67c00',
                    'tertiary'         => '#006096',
                    'outline'          => '#d4c499',
                    'outline_variant'  => '#c8b880',
                    'radius_button'    => '999px',
                    'radius_card'      => '16px',
                    'glass_opacity'    => '0.85',
                    'glass_blur'       => '20px',
                ],
                'defaults' => [
                    'hero' => ['subheadline' => 'Pan artesano horneado cada mañana', 'cta_text' => 'Ver productos'],
                    'menu' => ['items' => [
                        ['name' => 'Hogaza de masa madre',  'price' => '5€',   'description' => 'Fermentación lenta 24h, corteza crujiente', 'image' => ''],
                        ['name' => 'Croissant mantequilla', 'price' => '2,5€', 'description' => 'Laminado artesanal con mantequilla AOP',    'image' => ''],
                        ['name' => 'Tarta de manzana',      'price' => '4€',   'description' => 'Masa quebrada con manzana caramelizada',    'image' => ''],
                    ]],
                ],
            ],
        ];
    }

    private function serviciosVariants(): array
    {
        return [
            'carpinteria' => [
                'label'       => 'Carpintería',
                'color'       => '#712c00',
                'placeholder' => 'Ej: Carpintería Robles',
                'typography'  => ['heading' => 'Raleway', 'body' => 'Lato'],
                'is_active'   => true,
                'sort_order'  => 10,
                'theme_colors' => [
                    'surface'          => '#fcf9f7',
                    'surface_low'      => '#f6f3f1',
                    'surface_lowest'   => '#ffffff',
                    'surface_high'     => '#e5e2e0',
                    'on_surface'       => '#1e1510',
                    'on_surface_muted' => '#6b5040',
                    'secondary'        => '#712c00',
                    'tertiary'         => '#5c4030',
                    'outline'          => '#dcc1b6',
                    'outline_variant'  => '#dcc1b6',
                    'radius_button'    => '4px',
                    'radius_card'      => '2px',
                    'glass_opacity'    => '0.85',
                    'glass_blur'       => '20px',
                ],
                'defaults' => [
                    'hero' => ['subheadline' => 'Muebles a medida con madera noble', 'cta_text' => 'Pedir presupuesto'],
                    'services' => ['items' => [
                        ['name' => 'Muebles a medida', 'price' => 'Presupuesto',  'description' => 'Diseño y fabricación personalizada',   'image' => ''],
                        ['name' => 'Restauración',     'price' => 'Desde 80€',   'description' => 'Recuperamos muebles con historia',     'image' => ''],
                        ['name' => 'Tarimas y suelos', 'price' => 'Desde 25€/m²','description' => 'Instalación y lijado de parquet',     'image' => ''],
                    ]],
                ],
            ],

            'mudanza' => [
                'label'       => 'Mudanzas',
                'color'       => '#006948',
                'placeholder' => 'Ej: Mudanzas Rápidas García',
                'typography'  => ['heading' => 'Montserrat', 'body' => 'Open Sans'],
                'is_active'   => true,
                'sort_order'  => 11,
                'theme_colors' => [
                    'surface'          => '#d8fff0',
                    'surface_low'      => '#befee8',
                    'surface_lowest'   => '#ffffff',
                    'surface_high'     => '#9ffdd8',
                    'on_surface'       => '#00362a',
                    'on_surface_muted' => '#1a6b50',
                    'secondary'        => '#006948',
                    'tertiary'         => '#00dcfe',
                    'outline'          => '#7fcfb0',
                    'outline_variant'  => '#70c4a5',
                    'radius_button'    => '6px',
                    'radius_card'      => '4px',
                    'glass_opacity'    => '0.70',
                    'glass_blur'       => '12px',
                ],
                'defaults' => [
                    'hero' => ['subheadline' => 'Tu mudanza, sin estrés y a tiempo', 'cta_text' => 'Pedir presupuesto'],
                    'services' => ['items' => [
                        ['name' => 'Mudanza local',    'price' => 'Desde 150€',   'description' => 'Dentro de la misma ciudad, mismo día', 'image' => ''],
                        ['name' => 'Mudanza nacional', 'price' => 'Presupuesto',  'description' => 'A cualquier punto de España',          'image' => ''],
                        ['name' => 'Guardamuebles',    'price' => 'Desde 50€/mes','description' => 'Almacenaje seguro y asegurado',        'image' => ''],
                    ]],
                ],
            ],

            'cuidados' => [
                'label'       => 'Cuidados y Personas',
                'color'       => '#742fe5',
                'placeholder' => 'Ej: Cuidados con Cariño',
                'typography'  => ['heading' => 'Raleway', 'body' => 'Nunito'],
                'is_active'   => true,
                'sort_order'  => 12,
                'theme_colors' => [
                    'surface'          => '#fef7fe',
                    'surface_low'      => '#f8f1fa',
                    'surface_lowest'   => '#ffffff',
                    'surface_high'     => '#ecdef0',
                    'on_surface'       => '#34313a',
                    'on_surface_muted' => '#7d6b8a',
                    'secondary'        => '#742fe5',
                    'tertiary'         => '#7d516e',
                    'outline'          => '#b6b0bb',
                    'outline_variant'  => '#b6b0bb',
                    'radius_button'    => '6px',
                    'radius_card'      => '6px',
                    'glass_opacity'    => '0.70',
                    'glass_blur'       => '24px',
                ],
                'defaults' => [
                    'hero' => ['subheadline' => 'Cuidado profesional con corazón', 'cta_text' => 'Contactar ahora'],
                    'services' => ['items' => [
                        ['name' => 'Cuidado de mayores',  'price' => 'Consultar',   'description' => 'Atención domiciliaria y acompañamiento',  'image' => ''],
                        ['name' => 'Cuidado infantil',    'price' => 'Desde 12€/h', 'description' => 'Canguros con experiencia certificada',     'image' => ''],
                        ['name' => 'Asistencia personal', 'price' => 'Consultar',   'description' => 'Apoyo en tareas del hogar y gestiones',    'image' => ''],
                    ]],
                ],
            ],

            'fontaneria' => [
                'label'       => 'Fontanería',
                'color'       => '#0037b0',
                'placeholder' => 'Ej: Fontanería Aqua',
                'typography'  => ['heading' => 'Oswald', 'body' => 'Inter'],
                'is_active'   => true,
                'sort_order'  => 13,
                'theme_colors' => [
                    'surface'          => '#faf8ff',
                    'surface_low'      => '#f3f2fe',
                    'surface_lowest'   => '#ffffff',
                    'surface_high'     => '#e0defb',
                    'on_surface'       => '#1a1b23',
                    'on_surface_muted' => '#5a5c70',
                    'secondary'        => '#0037b0',
                    'tertiary'         => '#7f2500',
                    'outline'          => '#c4c5d7',
                    'outline_variant'  => '#c4c5d7',
                    'radius_button'    => '6px',
                    'radius_card'      => '6px',
                    'glass_opacity'    => '0.85',
                    'glass_blur'       => '16px',
                ],
                'defaults' => [
                    'hero' => ['subheadline' => 'Fontanería de precisión, urgencias 24h', 'cta_text' => 'Llamar ahora'],
                    'services' => ['items' => [
                        ['name' => 'Reparación de averías',  'price' => 'Desde 40€',  'description' => 'Fugas, atascos y roturas en el acto', 'image' => ''],
                        ['name' => 'Instalación sanitaria',  'price' => 'Presupuesto', 'description' => 'Baños, cocinas y calderas',           'image' => ''],
                        ['name' => 'Urgencias 24h',          'price' => 'Consultar',   'description' => 'Disponibles cualquier día y hora',    'image' => ''],
                    ]],
                ],
            ],

            'limpieza' => [
                'label'       => 'Limpieza',
                'color'       => '#006591',
                'placeholder' => 'Ej: Limpiezas Cristal',
                'typography'  => ['heading' => 'Nunito', 'body' => 'Inter'],
                'is_active'   => true,
                'sort_order'  => 14,
                'theme_colors' => [
                    'surface'          => '#f6faff',
                    'surface_low'      => '#f0f4fa',
                    'surface_lowest'   => '#ffffff',
                    'surface_high'     => '#dee8f4',
                    'on_surface'       => '#171c20',
                    'on_surface_muted' => '#4a5c6a',
                    'secondary'        => '#006591',
                    'tertiary'         => '#0ea5e9',
                    'outline'          => '#bec8d2',
                    'outline_variant'  => '#bec8d2',
                    'radius_button'    => '6px',
                    'radius_card'      => '6px',
                    'glass_opacity'    => '0.85',
                    'glass_blur'       => '20px',
                ],
                'defaults' => [
                    'hero' => ['subheadline' => 'Limpieza profesional para hogares y empresas', 'cta_text' => 'Pedir presupuesto'],
                    'services' => ['items' => [
                        ['name' => 'Limpieza del hogar',    'price' => 'Desde 60€',  'description' => 'Limpieza profunda y mantenimiento',  'image' => ''],
                        ['name' => 'Limpieza de oficinas',  'price' => 'Desde 80€',  'description' => 'Servicio diario o semanal',          'image' => ''],
                        ['name' => 'Limpieza post-obra',    'price' => 'Presupuesto','description' => 'Retirada de escombros y polvo fino', 'image' => ''],
                    ]],
                ],
            ],
        ];
    }

    private function ropaVariants(): array
    {
        return [
            'informal' => [
                'label'       => 'Streetwear / Informal',
                'color'       => '#815100',
                'placeholder' => 'Ej: Urban Threads',
                'typography'  => ['heading' => 'Plus Jakarta Sans', 'body' => 'Be Vietnam Pro'],
                'is_active'   => true,
                'sort_order'  => 10,
                'theme_colors' => [
                    'surface'          => '#f6f6f6',
                    'surface_low'      => '#f0f1f1',
                    'surface_lowest'   => '#ffffff',
                    'surface_high'     => '#e1e3e3',
                    'on_surface'       => '#2d2f2f',
                    'on_surface_muted' => '#6b6e6e',
                    'secondary'        => '#815100',
                    'tertiary'         => '#f8a010',
                    'outline'          => '#acadad',
                    'outline_variant'  => '#acadad',
                    'radius_button'    => '6px',
                    'radius_card'      => '6px',
                    'glass_opacity'    => '0.70',
                    'glass_blur'       => '20px',
                ],
                'defaults' => [
                    'hero' => ['subheadline' => 'Estilo urbano, actitud propia', 'cta_text' => 'Ver colección'],
                    'products' => ['items' => [
                        ['name' => 'Hoodie premium', 'price' => '55€', 'description' => 'Algodón orgánico 380g. Unisex.',          'image' => ''],
                        ['name' => 'Cargo pants',    'price' => '75€', 'description' => 'Corte holgado. 6 bolsillos funcionales.', 'image' => ''],
                        ['name' => 'Tee oversize',   'price' => '35€', 'description' => 'Corte relajado. Tallas XS–XXL.',         'image' => ''],
                    ]],
                ],
            ],

            'sport' => [
                'label'       => 'Sport / Fitness',
                'color'       => '#e02928',
                'placeholder' => 'Ej: Apex Performance',
                'typography'  => ['heading' => 'Oswald', 'body' => 'Inter'],
                'is_active'   => true,
                'sort_order'  => 11,
                'theme_colors' => [
                    'surface'          => '#0e0e0e',
                    'surface_low'      => '#1a1a1a',
                    'surface_lowest'   => '#000000',
                    'surface_high'     => '#2c2c2c',
                    'on_surface'       => '#e8e0d0',
                    'on_surface_muted' => '#9a9090',
                    'secondary'        => '#e02928',
                    'tertiary'         => '#ff8e82',
                    'outline'          => '#484848',
                    'outline_variant'  => '#484848',
                    'radius_button'    => '4px',
                    'radius_card'      => '4px',
                    'glass_opacity'    => '0.80',
                    'glass_blur'       => '20px',
                ],
                'defaults' => [
                    'hero' => ['subheadline' => 'Ropa técnica para atletas de verdad', 'cta_text' => 'Ver colección'],
                    'products' => ['items' => [
                        ['name' => 'Camiseta técnica',    'price' => '45€', 'description' => 'Tejido DryFit, compresión media.',        'image' => ''],
                        ['name' => 'Mallas running',      'price' => '65€', 'description' => 'Alto rendimiento, bolsillo posterior.',   'image' => ''],
                        ['name' => 'Chaqueta cortaviento','price' => '90€', 'description' => 'Ultraligera, pack-in-pocket.',            'image' => ''],
                    ]],
                ],
            ],

            'formal' => [
                'label'       => 'Moda Formal / Luxe',
                'color'       => '#625d5b',
                'placeholder' => 'Ej: Atelier Sartorial',
                'typography'  => ['heading' => 'Noto Serif', 'body' => 'Inter'],
                'is_active'   => true,
                'sort_order'  => 12,
                'theme_colors' => [
                    'surface'          => '#fff8f5',
                    'surface_low'      => '#fbf2ed',
                    'surface_lowest'   => '#ffffff',
                    'surface_high'     => '#ede0d8',
                    'on_surface'       => '#2d2422',
                    'on_surface_muted' => '#8a7068',
                    'secondary'        => '#625d5b',
                    'tertiary'         => '#9b8070',
                    'outline'          => '#d4c4b8',
                    'outline_variant'  => '#c8b4a8',
                    'radius_button'    => '0px',
                    'radius_card'      => '0px',
                    'glass_opacity'    => '0.80',
                    'glass_blur'       => '24px',
                ],
                'defaults' => [
                    'hero' => ['subheadline' => 'Elegancia atemporal, confección a medida', 'cta_text' => 'Ver colección'],
                    'products' => ['items' => [
                        ['name' => 'Traje a medida',      'price' => '490€', 'description' => 'Lana merino italiana. Entrega 3 semanas.',  'image' => ''],
                        ['name' => 'Camisa Oxford',       'price' => '95€',  'description' => 'Algodón egipcio 120/2. Cuello italiano.',   'image' => ''],
                        ['name' => 'Blazer estructurado', 'price' => '280€', 'description' => 'Forro completo. Hombrera reforzada.',       'image' => ''],
                    ]],
                ],
            ],
        ];
    }
}
