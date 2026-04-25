<?php

namespace Database\Seeders;

use App\Models\CatalogSector;
use App\Models\CatalogVariant;
use Illuminate\Database\Seeder;

class NewDesignsCatalogSeeder extends Seeder
{
    public function run(): void
    {
        // ── 1. Actualizar theme_colors en variants existentes ──────────────

        $this->setThemeColors('peluqueria', 'salon', [
            'surface'          => '#fcf9f4',
            'surface_low'      => '#f6f3ee',
            'surface_lowest'   => '#ffffff',
            'surface_high'     => '#e5e2dd',
            'on_surface'       => '#1c1c19',
            'on_surface_muted' => '#6b6b67',
            'secondary'        => '#7b5455',
            'tertiary'         => '#a08060',
            'outline'          => '#c8c4be',
            'outline_variant'  => '#c8c4be',
            'radius_button'    => '999px',
            'radius_card'      => '16px',
            'glass_opacity'    => '0.90',
            'glass_blur'       => '20px',
        ]);

        $this->setThemeColors('peluqueria', 'barbershop', [
            'surface'          => '#131313',
            'surface_low'      => '#1c1c1c',
            'surface_lowest'   => '#242424',
            'surface_high'     => '#0d0d0d',
            'on_surface'       => '#e8e0d0',
            'on_surface_muted' => '#a0978a',
            'secondary'        => '#8B1A1A',
            'tertiary'         => '#5a4030',
            'outline'          => '#3a3530',
        ]);

        $this->setThemeColors('comida', 'cafeteria', [
            'surface'          => '#FFF8F1',
            'surface_low'      => '#F9F3EB',
            'surface_lowest'   => '#FFFFFF',
            'surface_high'     => '#ede5d8',
            'on_surface'       => '#1E1B17',
            'on_surface_muted' => '#6b5e50',
            'secondary'        => '#92400E',
            'tertiary'         => '#5c4033',
            'outline'          => '#d4c4b0',
            'outline_variant'  => '#d4c4b0',
            'radius_button'    => '4px',
            'radius_card'      => '8px',
            'glass_opacity'    => '0.85',
            'glass_blur'       => '16px',
        ]);

        $this->setThemeColors('comida', 'restaurante', [
            'surface'          => '#100e0c',
            'surface_low'      => '#1a1612',
            'surface_lowest'   => '#000000',
            'surface_high'     => '#241f1a',
            'on_surface'       => '#f0ebe6',
            'on_surface_muted' => '#a09890',
            'secondary'        => '#4a4643',
            'tertiary'         => '#ba573f',
            'outline'          => '#7d746d',
            'outline_variant'  => '#3a342e',
            'radius_button'    => '0px',
            'radius_card'      => '4px',
            'glass_opacity'    => '0.75',
            'glass_blur'       => '20px',
        ]);

        $this->setThemeColors('servicios', 'electricista', [
            'surface'          => '#faf8ff',
            'surface_low'      => '#f3f3fe',
            'surface_lowest'   => '#ffffff',
            'surface_high'     => '#e0e0f8',
            'on_surface'       => '#191b23',
            'on_surface_muted' => '#5a5c70',
            'secondary'        => '#2563eb',
            'tertiary'         => '#943700',
            'outline'          => '#c0c0e0',
            'outline_variant'  => '#c0c0e0',
            'radius_button'    => '4px',
            'radius_card'      => '8px',
            'glass_opacity'    => '0.88',
            'glass_blur'       => '12px',
        ]);

        // ── 2. Nuevo variant en peluquería: iron_oak ───────────────────────

        $peluqueria = CatalogSector::where('key', 'peluqueria')->first();
        if ($peluqueria) {
            CatalogVariant::updateOrCreate(
                ['sector_id' => $peluqueria->id, 'key' => 'iron_oak'],
                [
                    'label'        => 'Barbería Premium',
                    'color'        => '#E9C349',
                    'placeholder'  => 'Ej: Iron & Oak Barbers',
                    'typography'   => ['heading' => 'Bebas Neue', 'body' => 'Inter'],
                    'is_active'    => true,
                    'sort_order'   => 10,
                    'theme_colors' => [
                        'surface'          => '#131313',
                        'surface_low'      => '#1c1c1c',
                        'surface_lowest'   => '#242424',
                        'surface_high'     => '#0d0d0d',
                        'on_surface'       => '#e8e0d0',
                        'on_surface_muted' => '#a0978a',
                        'secondary'        => '#8B1A1A',
                        'tertiary'         => '#5a4030',
                        'outline'          => '#3a3530',
                        'outline_variant'  => '#58413F',
                        'radius_button'    => '0px',
                        'radius_card'      => '0px',
                        'glass_opacity'    => '0.7',
                        'glass_blur'       => '12px',
                    ],
                    'defaults' => [
                        'hero' => [
                            'bg_image'    => '/images/defaults/slider/slider_1.png',
                            'bg_image_2'  => '/images/defaults/slider/slider_2.png',
                            'bg_image_3'  => '/images/defaults/slider/slider_3.png',
                            'subheadline' => 'El arte del corte clásico',
                            'cta_text'    => 'Reserva tu cita',
                        ],
                        'services' => ['items' => [
                            ['name' => 'Corte clásico',  'price' => '18€', 'description' => 'Corte de precisión con navaja y tijera',         'image' => '/images/defaults/services/serv-1.png'],
                            ['name' => 'Barba completa', 'price' => '12€', 'description' => 'Afeitado caliente y perfilado profesional',       'image' => '/images/defaults/services/serv-2.png'],
                            ['name' => 'Corte + Barba',  'price' => '25€', 'description' => 'Servicio completo con ritual de cuidado',         'image' => '/images/defaults/services/serv-3.png'],
                        ]],
                        'gallery' => ['items' => [
                            ['image' => '/images/defaults/gallery/photo-1.png', 'caption' => ''],
                            ['image' => '/images/defaults/gallery/photo-2.png', 'caption' => ''],
                            ['image' => '/images/defaults/gallery/photo-3.png', 'caption' => ''],
                            ['image' => '/images/defaults/gallery/photo-4.png', 'caption' => ''],
                            ['image' => '/images/defaults/gallery/photo-5.png', 'caption' => ''],
                            ['image' => '/images/defaults/gallery/photo-6.png', 'caption' => ''],
                        ]],
                        'team' => ['items' => [
                            ['name' => 'Carlos López', 'role' => 'Master Barber', 'photo' => '/images/defaults/team/team_photo_1.png'],
                            ['name' => 'David Ruiz',   'role' => 'Barbero',       'photo' => '/images/defaults/team/team_photo_2.png'],
                        ]],
                    ],
                ]
            );
        }

        // ── 3. Nuevo sector: Salón de Belleza ─────────────────────────────

        $salon = CatalogSector::updateOrCreate(
            ['key' => 'salon_belleza'],
            [
                'label'        => 'Salón de Belleza',
                'icon'         => '💅',
                'template_key' => 'salon',
                'sort_order'   => 2,
            ]
        );

        CatalogVariant::updateOrCreate(
            ['sector_id' => $salon->id, 'key' => 'salon_clasico'],
            [
                'label'        => 'Salón Clásico',
                'color'        => '#C8A96E',
                'placeholder'  => 'Ej: Aura Beauty Studio',
                'typography'   => ['heading' => 'Noto Serif', 'body' => 'Manrope'],
                'is_active'    => true,
                'sort_order'   => 0,
                'theme_colors' => [
                    'surface'          => '#fcf9f4',
                    'surface_low'      => '#f6f3ee',
                    'surface_lowest'   => '#ffffff',
                    'surface_high'     => '#e5e2dd',
                    'on_surface'       => '#1c1c19',
                    'on_surface_muted' => '#6b6b67',
                    'secondary'        => '#D4A5A5',
                    'tertiary'         => '#a08060',
                    'outline'          => '#c8c4be',
                ],
                'defaults' => [
                    'hero' => [
                        'bg_image'    => '/images/defaults/salon/slider_1.png',
                        'bg_image_2'  => '/images/defaults/salon/slider_2.png',
                        'bg_image_3'  => '/images/defaults/salon/slider_3.png',
                        'subheadline' => 'Belleza que se siente, elegancia que se ve',
                        'cta_text'    => 'Reserva tu cita',
                    ],
                    'services' => ['items' => [
                        ['name' => 'Corte y peinado', 'price' => '35€', 'description' => 'Corte personalizado y secado profesional',       'image' => '/images/defaults/salon/serv-1.png'],
                        ['name' => 'Coloración',      'price' => '55€', 'description' => 'Tinte y coloración con productos premium',       'image' => '/images/defaults/salon/serv-2.png'],
                        ['name' => 'Tratamiento',     'price' => '45€', 'description' => 'Hidratación y cuidado profundo del cabello',     'image' => '/images/defaults/salon/serv-3.png'],
                    ]],
                    'gallery' => ['items' => [
                        ['image' => '/images/defaults/salon/photo-1.png', 'caption' => ''],
                        ['image' => '/images/defaults/salon/photo-2.png', 'caption' => ''],
                        ['image' => '/images/defaults/salon/photo-3.png', 'caption' => ''],
                        ['image' => '/images/defaults/salon/photo-4.png', 'caption' => ''],
                        ['image' => '/images/defaults/salon/photo-5.png', 'caption' => ''],
                        ['image' => '/images/defaults/salon/photo-6.png', 'caption' => ''],
                    ]],
                    'team' => ['items' => [
                        ['name' => 'María García',  'role' => 'Estilista Principal', 'photo' => '/images/defaults/salon/team_1.png'],
                        ['name' => 'Laura Sánchez', 'role' => 'Colorista',           'photo' => '/images/defaults/salon/team_2.png'],
                        ['name' => 'Sofía Ruiz',    'role' => 'Especialista',        'photo' => '/images/defaults/salon/team_3.png'],
                    ]],
                ],
            ]
        );

        // ── 4. Nuevos variants de comida ───────────────────────────────────

        $comida = CatalogSector::where('key', 'comida')->first();
        if ($comida) {
            $foodVariants = [
                'brunch' => [
                    'label' => 'Brunch', 'color' => '#006948', 'placeholder' => 'Ej: Melbourne Brunch Co.',
                    'typography' => ['heading' => 'Poppins', 'body' => 'Inter'],
                    'sort_order' => 10,
                    'theme_colors' => [
                        'surface' => '#f0fdf4', 'surface_low' => '#eaf7ee', 'surface_lowest' => '#ffffff',
                        'surface_high' => '#deebe3', 'on_surface' => '#131e19', 'on_surface_muted' => '#4a6355',
                        'secondary' => '#00855d', 'tertiary' => '#9b5b00', 'outline' => '#bccac0',
                    ],
                    'defaults' => [
                        'hero' => ['bg_image' => '/images/defaults/restaurante/slider_1.png', 'bg_image_2' => '/images/defaults/restaurante/slider_2.png', 'bg_image_3' => '/images/defaults/restaurante/slider_3.png', 'subheadline' => 'El brunch que mereces, cada fin de semana', 'cta_text' => 'Ver carta'],
                        'menu' => ['items' => [
                            ['name' => 'Eggs Benedict',  'price' => '12€', 'description' => 'Huevos pochados con salsa holandesa',  'image' => '/images/defaults/restaurante/serv-1.png'],
                            ['name' => 'Avocado Toast',  'price' => '9€',  'description' => 'Pan de masa madre con aguacate',       'image' => '/images/defaults/restaurante/serv-2.png'],
                            ['name' => 'Pancakes Stack', 'price' => '10€', 'description' => 'Torre de pancakes con sirope de arce', 'image' => '/images/defaults/restaurante/serv-3.png'],
                        ]],
                        'gallery' => ['items' => [
                            ['image' => '/images/defaults/restaurante/photo-1.png', 'caption' => ''],
                            ['image' => '/images/defaults/restaurante/photo-2.png', 'caption' => ''],
                            ['image' => '/images/defaults/restaurante/photo-3.png', 'caption' => ''],
                            ['image' => '/images/defaults/restaurante/photo-4.png', 'caption' => ''],
                        ]],
                    ],
                ],
                'italiano' => [
                    'label' => 'Italiano', 'color' => '#B70011', 'placeholder' => 'Ej: Trattoria Bella',
                    'typography' => ['heading' => 'Playfair Display', 'body' => 'Lato'],
                    'sort_order' => 11,
                    'theme_colors' => [
                        'surface' => '#FFF8F1', 'surface_low' => '#f5ede0', 'surface_lowest' => '#ffffff',
                        'surface_high' => '#e8d5c0', 'on_surface' => '#1E1B17', 'on_surface_muted' => '#5a4a38',
                        'secondary' => '#5A632E', 'tertiary' => '#8B1A1A', 'outline' => '#d4bea8',
                    ],
                    'defaults' => [
                        'hero' => ['bg_image' => '/images/defaults/restaurante/slider_1.png', 'bg_image_2' => '/images/defaults/restaurante/slider_2.png', 'bg_image_3' => '/images/defaults/restaurante/slider_3.png', 'subheadline' => 'Cucina auténtica, sabores de la nonna', 'cta_text' => 'Reservar mesa'],
                        'menu' => ['items' => [
                            ['name' => 'Tagliatelle al ragù', 'price' => '14€', 'description' => 'Pasta fresca con ragù de ternera',     'image' => '/images/defaults/restaurante/serv-1.png'],
                            ['name' => 'Pizza Margherita',    'price' => '12€', 'description' => 'Base de tomate San Marzano y burrata', 'image' => '/images/defaults/restaurante/serv-2.png'],
                            ['name' => 'Tiramisù',            'price' => '6€',  'description' => 'Receta original de la casa',           'image' => '/images/defaults/restaurante/serv-3.png'],
                        ]],
                        'gallery' => ['items' => [
                            ['image' => '/images/defaults/restaurante/photo-1.png', 'caption' => ''],
                            ['image' => '/images/defaults/restaurante/photo-2.png', 'caption' => ''],
                            ['image' => '/images/defaults/restaurante/photo-3.png', 'caption' => ''],
                            ['image' => '/images/defaults/restaurante/photo-4.png', 'caption' => ''],
                        ]],
                    ],
                ],
                'japones' => [
                    'label' => 'Japonés', 'color' => '#565e74', 'placeholder' => 'Ej: Zen Sushi & Ramen',
                    'typography' => ['heading' => 'Montserrat', 'body' => 'Inter'],
                    'sort_order' => 12,
                    'theme_colors' => [
                        'surface' => '#f7f9fb', 'surface_low' => '#f0f4f7', 'surface_lowest' => '#ffffff',
                        'surface_high' => '#dde3e8', 'on_surface' => '#2a3439', 'on_surface_muted' => '#5e6b73',
                        'secondary' => '#4a5268', 'tertiary' => '#7f2500', 'outline' => '#a9b4b9',
                    ],
                    'defaults' => [
                        'hero' => ['bg_image' => '/images/defaults/restaurante/slider_1.png', 'bg_image_2' => '/images/defaults/restaurante/slider_2.png', 'bg_image_3' => '/images/defaults/restaurante/slider_3.png', 'subheadline' => 'Precisión japonesa, sabor auténtico', 'cta_text' => 'Ver carta'],
                        'menu' => ['items' => [
                            ['name' => 'Sashimi Premium',    'price' => '18€', 'description' => 'Selección de pescado fresco del día', 'image' => '/images/defaults/restaurante/serv-1.png'],
                            ['name' => 'Ramen Tonkotsu',     'price' => '14€', 'description' => 'Caldo cremoso de cerdo 12 horas',     'image' => '/images/defaults/restaurante/serv-2.png'],
                            ['name' => 'Nigiri Box (8 pzs)', 'price' => '16€', 'description' => 'Selección del chef',                 'image' => '/images/defaults/restaurante/serv-3.png'],
                        ]],
                        'gallery' => ['items' => [
                            ['image' => '/images/defaults/restaurante/photo-1.png', 'caption' => ''],
                            ['image' => '/images/defaults/restaurante/photo-2.png', 'caption' => ''],
                            ['image' => '/images/defaults/restaurante/photo-3.png', 'caption' => ''],
                            ['image' => '/images/defaults/restaurante/photo-4.png', 'caption' => ''],
                        ]],
                    ],
                ],
                'panaderia' => [
                    'label' => 'Panadería', 'color' => '#8d4b00', 'placeholder' => 'Ej: El Horno de Artesano',
                    'typography' => ['heading' => 'Merriweather', 'body' => 'Lato'],
                    'sort_order' => 13,
                    'theme_colors' => [
                        'surface' => '#fdf9e9', 'surface_low' => '#f5f0d8', 'surface_lowest' => '#ffffff',
                        'surface_high' => '#e8e0c8', 'on_surface' => '#1c1c13', 'on_surface_muted' => '#6b6040',
                        'secondary' => '#5c4a00', 'tertiary' => '#006096', 'outline' => '#d4c890',
                    ],
                    'defaults' => [
                        'hero' => ['bg_image' => '/images/defaults/restaurante/slider_1.png', 'bg_image_2' => '/images/defaults/restaurante/slider_2.png', 'bg_image_3' => '/images/defaults/restaurante/slider_3.png', 'subheadline' => 'Pan de masa madre. Horneado cada mañana.', 'cta_text' => 'Ver productos'],
                        'menu' => ['items' => [
                            ['name' => 'Pan de masa madre',     'price' => '4€',   'description' => 'Fermentación lenta 24h, corteza crujiente',  'image' => '/images/defaults/restaurante/serv-1.png'],
                            ['name' => 'Croissant mantequilla', 'price' => '2€',   'description' => 'Hojaldrado artesanal con mantequilla AOP',    'image' => '/images/defaults/restaurante/serv-2.png'],
                            ['name' => 'Tarta de manzana',      'price' => '3.5€', 'description' => 'Receta de la abuela, todos los días',          'image' => '/images/defaults/restaurante/serv-3.png'],
                        ]],
                        'gallery' => ['items' => [
                            ['image' => '/images/defaults/restaurante/photo-1.png', 'caption' => ''],
                            ['image' => '/images/defaults/restaurante/photo-2.png', 'caption' => ''],
                            ['image' => '/images/defaults/restaurante/photo-3.png', 'caption' => ''],
                            ['image' => '/images/defaults/restaurante/photo-4.png', 'caption' => ''],
                        ]],
                    ],
                ],
            ];

            foreach ($foodVariants as $key => $data) {
                CatalogVariant::updateOrCreate(
                    ['sector_id' => $comida->id, 'key' => $key],
                    array_merge($data, ['is_active' => true])
                );
            }
        }

        // ── 5. Nuevos variants de servicios ───────────────────────────────

        $servicios = CatalogSector::where('key', 'servicios')->first();
        if ($servicios) {
            $serviceVariants = [
                'fontaneria' => [
                    'label' => 'Fontanería', 'color' => '#0037b0', 'placeholder' => 'Ej: Fontanería Pérez',
                    'typography' => ['heading' => 'Poppins', 'body' => 'Inter'],
                    'sort_order' => 10,
                    'theme_colors' => [
                        'surface' => '#faf8ff', 'surface_low' => '#f3f2fe', 'surface_lowest' => '#ffffff',
                        'surface_high' => '#dddcf8', 'on_surface' => '#1a1b23', 'on_surface_muted' => '#5a5c70',
                        'secondary' => '#1D4ED8', 'tertiary' => '#7f2500', 'outline' => '#c4c5d7',
                    ],
                    'defaults' => [
                        'hero' => ['bg_image' => '/images/defaults/slider/slider_1.png', 'bg_image_2' => '/images/defaults/slider/slider_2.png', 'bg_image_3' => '/images/defaults/slider/slider_3.png', 'subheadline' => 'Fontanería de confianza, disponible 24h', 'cta_text' => 'Pedir presupuesto'],
                        'services' => ['items' => [
                            ['name' => 'Reparación de averías', 'price' => 'Desde 40€',  'description' => 'Diagnóstico y reparación en el acto', 'image' => '/images/defaults/services/serv-1.png'],
                            ['name' => 'Instalación de baños',  'price' => 'Presupuesto', 'description' => 'Montaje completo de sanitarios',      'image' => '/images/defaults/services/serv-2.png'],
                            ['name' => 'Desatascos',            'price' => 'Desde 50€',  'description' => 'Desatasco garantizado en 1h',          'image' => '/images/defaults/services/serv-3.png'],
                        ]],
                        'gallery' => ['items' => [
                            ['image' => '/images/defaults/gallery/photo-1.png', 'caption' => ''],
                            ['image' => '/images/defaults/gallery/photo-2.png', 'caption' => ''],
                            ['image' => '/images/defaults/gallery/photo-3.png', 'caption' => ''],
                            ['image' => '/images/defaults/gallery/photo-4.png', 'caption' => ''],
                        ]],
                    ],
                ],
                'carpinteria' => [
                    'label' => 'Carpintería', 'color' => '#712c00', 'placeholder' => 'Ej: Carpintería Artesanal Ruiz',
                    'typography' => ['heading' => 'Merriweather', 'body' => 'Lato'],
                    'sort_order' => 11,
                    'theme_colors' => [
                        'surface' => '#fcf9f7', 'surface_low' => '#f6f3f1', 'surface_lowest' => '#ffffff',
                        'surface_high' => '#e5e2e0', 'on_surface' => '#2c1f15', 'on_surface_muted' => '#7a6858',
                        'secondary' => '#5a3a20', 'tertiary' => '#7b5030', 'outline' => '#dcc1b6',
                    ],
                    'defaults' => [
                        'hero' => ['bg_image' => '/images/defaults/slider/slider_1.png', 'bg_image_2' => '/images/defaults/slider/slider_2.png', 'bg_image_3' => '/images/defaults/slider/slider_3.png', 'subheadline' => 'Madera trabajada a mano, piezas que duran toda la vida', 'cta_text' => 'Pedir presupuesto'],
                        'services' => ['items' => [
                            ['name' => 'Muebles a medida',   'price' => 'Presupuesto', 'description' => 'Diseño y fabricación personalizada', 'image' => '/images/defaults/services/serv-1.png'],
                            ['name' => 'Restauración',       'price' => 'Desde 80€',  'description' => 'Recuperamos tus muebles antiguos',   'image' => '/images/defaults/services/serv-2.png'],
                            ['name' => 'Puertas y ventanas', 'price' => 'Presupuesto', 'description' => 'Carpintería exterior e interior',    'image' => '/images/defaults/services/serv-3.png'],
                        ]],
                        'gallery' => ['items' => [
                            ['image' => '/images/defaults/gallery/photo-1.png', 'caption' => ''],
                            ['image' => '/images/defaults/gallery/photo-2.png', 'caption' => ''],
                            ['image' => '/images/defaults/gallery/photo-3.png', 'caption' => ''],
                            ['image' => '/images/defaults/gallery/photo-4.png', 'caption' => ''],
                        ]],
                    ],
                ],
                'cuidados' => [
                    'label' => 'Cuidados en el hogar', 'color' => '#742fe5', 'placeholder' => 'Ej: Cuidados Serene',
                    'typography' => ['heading' => 'Nunito', 'body' => 'Open Sans'],
                    'sort_order' => 12,
                    'theme_colors' => [
                        'surface' => '#fef7fe', 'surface_low' => '#f8f1fa', 'surface_lowest' => '#ffffff',
                        'surface_high' => '#e7e0ec', 'on_surface' => '#34313a', 'on_surface_muted' => '#7a6b80',
                        'secondary' => '#8342f4', 'tertiary' => '#7d516e', 'outline' => '#b6b0bb',
                    ],
                    'defaults' => [
                        'hero' => ['bg_image' => '/images/defaults/slider/slider_1.png', 'bg_image_2' => '/images/defaults/slider/slider_2.png', 'bg_image_3' => '/images/defaults/slider/slider_3.png', 'subheadline' => 'Cuidado y compañía para quien más quieres', 'cta_text' => 'Contactar'],
                        'services' => ['items' => [
                            ['name' => 'Cuidado de mayores',     'price' => 'Desde 12€/h', 'description' => 'Asistencia personalizada en el hogar',   'image' => '/images/defaults/services/serv-1.png'],
                            ['name' => 'Cuidado infantil',       'price' => 'Desde 10€/h', 'description' => 'Niñeras cualificadas y con experiencia', 'image' => '/images/defaults/services/serv-2.png'],
                            ['name' => 'Enfermería a domicilio', 'price' => 'Presupuesto', 'description' => 'Cuidados médicos en casa',               'image' => '/images/defaults/services/serv-3.png'],
                        ]],
                        'gallery' => ['items' => [
                            ['image' => '/images/defaults/gallery/photo-1.png', 'caption' => ''],
                            ['image' => '/images/defaults/gallery/photo-2.png', 'caption' => ''],
                            ['image' => '/images/defaults/gallery/photo-3.png', 'caption' => ''],
                            ['image' => '/images/defaults/gallery/photo-4.png', 'caption' => ''],
                        ]],
                    ],
                ],
                'limpieza' => [
                    'label' => 'Limpieza', 'color' => '#006591', 'placeholder' => 'Ej: Limpieza Crisp',
                    'typography' => ['heading' => 'Poppins', 'body' => 'Inter'],
                    'sort_order' => 13,
                    'theme_colors' => [
                        'surface' => '#f6faff', 'surface_low' => '#f0f4fa', 'surface_lowest' => '#ffffff',
                        'surface_high' => '#dde8f5', 'on_surface' => '#171c20', 'on_surface_muted' => '#4a5c6b',
                        'secondary' => '#0ea5e9', 'tertiary' => '#8b5000', 'outline' => '#bec8d2',
                    ],
                    'defaults' => [
                        'hero' => ['bg_image' => '/images/defaults/slider/slider_1.png', 'bg_image_2' => '/images/defaults/slider/slider_2.png', 'bg_image_3' => '/images/defaults/slider/slider_3.png', 'subheadline' => 'Tu hogar, impecable. Cada día.', 'cta_text' => 'Pedir presupuesto'],
                        'services' => ['items' => [
                            ['name' => 'Limpieza del hogar',   'price' => 'Desde 15€/h', 'description' => 'Limpieza completa y a fondo',          'image' => '/images/defaults/services/serv-1.png'],
                            ['name' => 'Limpieza de oficinas', 'price' => 'Presupuesto', 'description' => 'Servicio diario o semanal',             'image' => '/images/defaults/services/serv-2.png'],
                            ['name' => 'Limpieza post-obra',   'price' => 'Presupuesto', 'description' => 'Eliminamos escombros y polvo de obra', 'image' => '/images/defaults/services/serv-3.png'],
                        ]],
                        'gallery' => ['items' => [
                            ['image' => '/images/defaults/gallery/photo-1.png', 'caption' => ''],
                            ['image' => '/images/defaults/gallery/photo-2.png', 'caption' => ''],
                            ['image' => '/images/defaults/gallery/photo-3.png', 'caption' => ''],
                            ['image' => '/images/defaults/gallery/photo-4.png', 'caption' => ''],
                        ]],
                    ],
                ],
                'mudanza' => [
                    'label' => 'Mudanzas', 'color' => '#006948', 'placeholder' => 'Ej: Mudanzas Express',
                    'typography' => ['heading' => 'Oswald', 'body' => 'Roboto'],
                    'sort_order' => 14,
                    'theme_colors' => [
                        'surface' => '#d8fff0', 'surface_low' => '#befee8', 'surface_lowest' => '#ffffff',
                        'surface_high' => '#9af0d0', 'on_surface' => '#00362a', 'on_surface_muted' => '#1a6b50',
                        'secondary' => '#005b3e', 'tertiary' => '#00706b', 'outline' => '#80d4b8',
                    ],
                    'defaults' => [
                        'hero' => ['bg_image' => '/images/defaults/slider/slider_1.png', 'bg_image_2' => '/images/defaults/slider/slider_2.png', 'bg_image_3' => '/images/defaults/slider/slider_3.png', 'subheadline' => 'Tu mudanza, sin estrés. Con garantía.', 'cta_text' => 'Pedir presupuesto'],
                        'services' => ['items' => [
                            ['name' => 'Mudanza local',    'price' => 'Desde 150€',   'description' => 'Transporte y montaje en la misma ciudad', 'image' => '/images/defaults/services/serv-1.png'],
                            ['name' => 'Mudanza nacional', 'price' => 'Presupuesto',  'description' => 'A cualquier punto de España',             'image' => '/images/defaults/services/serv-2.png'],
                            ['name' => 'Guardamuebles',    'price' => 'Desde 50€/mes','description' => 'Almacenamiento seguro y asegurado',       'image' => '/images/defaults/services/serv-3.png'],
                        ]],
                        'gallery' => ['items' => [
                            ['image' => '/images/defaults/gallery/photo-1.png', 'caption' => ''],
                            ['image' => '/images/defaults/gallery/photo-2.png', 'caption' => ''],
                            ['image' => '/images/defaults/gallery/photo-3.png', 'caption' => ''],
                            ['image' => '/images/defaults/gallery/photo-4.png', 'caption' => ''],
                        ]],
                    ],
                ],
            ];

            foreach ($serviceVariants as $key => $data) {
                CatalogVariant::updateOrCreate(
                    ['sector_id' => $servicios->id, 'key' => $key],
                    array_merge($data, ['is_active' => true])
                );
            }
        }

        // ── 6. Nuevos variants de ropa ─────────────────────────────────────

        $ropa = CatalogSector::where('key', 'ropa')->first();
        if ($ropa) {
            $ropaVariants = [
                'formal' => [
                    'label' => 'Moda Formal', 'color' => '#625d5b', 'placeholder' => 'Ej: Sartorial Atelier',
                    'typography' => ['heading' => 'Noto Serif', 'body' => 'Inter'],
                    'sort_order' => 10,
                    'theme_colors' => [
                        'surface' => '#fff8f5', 'surface_low' => '#fbf2ed', 'surface_lowest' => '#ffffff',
                        'surface_high' => '#ede0d8', 'on_surface' => '#1a1510', 'on_surface_muted' => '#6b5a50',
                        'secondary' => '#9c8880', 'tertiary' => '#8B6B50', 'outline' => '#d4c0b8',
                    ],
                    'defaults' => [
                        'hero' => ['bg_image' => '/images/defaults/ropa/slider_1.png', 'bg_image_2' => '/images/defaults/ropa/slider_2.png', 'bg_image_3' => '/images/defaults/ropa/slider_3.png', 'subheadline' => 'Sastrería a medida para quien sabe lo que quiere', 'cta_text' => 'Ver colección'],
                        'products' => ['items' => [
                            ['name' => 'Traje a medida',   'price' => '450€', 'description' => 'Lana virgen, forrado, personalizado',  'image' => '/images/defaults/ropa/serv-1.png'],
                            ['name' => 'Camisa Oxford',    'price' => '85€',  'description' => '100% algodón egipcio, corte slim',     'image' => '/images/defaults/ropa/serv-2.png'],
                            ['name' => 'Abrigo cachemira', 'price' => '320€', 'description' => 'Mezcla de cachemira y lana merino',    'image' => '/images/defaults/ropa/serv-3.png'],
                        ]],
                        'gallery' => ['items' => [
                            ['image' => '/images/defaults/ropa/photo-1.png', 'caption' => ''],
                            ['image' => '/images/defaults/ropa/photo-2.png', 'caption' => ''],
                            ['image' => '/images/defaults/ropa/photo-3.png', 'caption' => ''],
                            ['image' => '/images/defaults/ropa/photo-4.png', 'caption' => ''],
                        ]],
                    ],
                ],
                'informal' => [
                    'label' => 'Moda Casual', 'color' => '#815100', 'placeholder' => 'Ej: Urban Pulse',
                    'typography' => ['heading' => 'Poppins', 'body' => 'Inter'],
                    'sort_order' => 11,
                    'theme_colors' => [
                        'surface' => '#f6f6f6', 'surface_low' => '#f0f1f1', 'surface_lowest' => '#ffffff',
                        'surface_high' => '#dbdddd', 'on_surface' => '#2d2f2f', 'on_surface_muted' => '#6b6d6d',
                        'secondary' => '#e1a020', 'tertiary' => '#4a3800', 'outline' => '#acadad',
                    ],
                    'defaults' => [
                        'hero' => ['bg_image' => '/images/defaults/ropa/slider_1.png', 'bg_image_2' => '/images/defaults/ropa/slider_2.png', 'bg_image_3' => '/images/defaults/ropa/slider_3.png', 'subheadline' => 'Estilo urbano, actitud propia', 'cta_text' => 'Ver colección'],
                        'products' => ['items' => [
                            ['name' => 'Camiseta oversize', 'price' => '35€', 'description' => 'Algodón orgánico, corte holgado',    'image' => '/images/defaults/ropa/serv-1.png'],
                            ['name' => 'Cargo pants',       'price' => '65€', 'description' => 'Múltiples bolsillos, fit relajado', 'image' => '/images/defaults/ropa/serv-2.png'],
                            ['name' => 'Sudadera hoodie',   'price' => '55€', 'description' => 'Fleece interior, capucha ajustable','image' => '/images/defaults/ropa/serv-3.png'],
                        ]],
                        'gallery' => ['items' => [
                            ['image' => '/images/defaults/ropa/photo-1.png', 'caption' => ''],
                            ['image' => '/images/defaults/ropa/photo-2.png', 'caption' => ''],
                            ['image' => '/images/defaults/ropa/photo-3.png', 'caption' => ''],
                            ['image' => '/images/defaults/ropa/photo-4.png', 'caption' => ''],
                        ]],
                    ],
                ],
                'sport' => [
                    'label' => 'Ropa Deportiva', 'color' => '#DC2626', 'placeholder' => 'Ej: Apex Sport',
                    'typography' => ['heading' => 'Oswald', 'body' => 'Inter'],
                    'sort_order' => 12,
                    'theme_colors' => [
                        'surface' => '#0e0e0e', 'surface_low' => '#191919', 'surface_lowest' => '#000000',
                        'surface_high' => '#2c2c2c', 'on_surface' => '#f0f0f0', 'on_surface_muted' => '#a0a0a0',
                        'secondary' => '#3a3a3a', 'tertiary' => '#ff8e82', 'outline' => '#484848',
                    ],
                    'defaults' => [
                        'hero' => ['bg_image' => '/images/defaults/ropa/slider_1.png', 'bg_image_2' => '/images/defaults/ropa/slider_2.png', 'bg_image_3' => '/images/defaults/ropa/slider_3.png', 'subheadline' => 'Rinde más. Muévete sin límites.', 'cta_text' => 'Ver colección'],
                        'products' => ['items' => [
                            ['name' => 'Camiseta técnica',    'price' => '45€', 'description' => 'Tejido transpirable DryFit',           'image' => '/images/defaults/ropa/serv-1.png'],
                            ['name' => 'Mallas de compresión','price' => '55€', 'description' => 'Compresión graduada, máxima sujeción', 'image' => '/images/defaults/ropa/serv-2.png'],
                            ['name' => 'Chaqueta cortavientos','price' => '89€','description' => 'Ligera, impermeable, plegable',        'image' => '/images/defaults/ropa/serv-3.png'],
                        ]],
                        'gallery' => ['items' => [
                            ['image' => '/images/defaults/ropa/photo-1.png', 'caption' => ''],
                            ['image' => '/images/defaults/ropa/photo-2.png', 'caption' => ''],
                            ['image' => '/images/defaults/ropa/photo-3.png', 'caption' => ''],
                            ['image' => '/images/defaults/ropa/photo-4.png', 'caption' => ''],
                        ]],
                    ],
                ],
            ];

            foreach ($ropaVariants as $key => $data) {
                CatalogVariant::updateOrCreate(
                    ['sector_id' => $ropa->id, 'key' => $key],
                    array_merge($data, ['is_active' => true])
                );
            }
        }

        // ── 7. Nuevo sector: Influencer ────────────────────────────────────

        $influencer = CatalogSector::updateOrCreate(
            ['key' => 'influencer'],
            [
                'label'        => 'Influencer / Links',
                'icon'         => '✨',
                'template_key' => 'influencer',
                'sort_order'   => 10,
            ]
        );

        CatalogVariant::updateOrCreate(
            ['sector_id' => $influencer->id, 'key' => 'editorial'],
            [
                'label'        => 'Editorial',
                'color'        => '#625d5b',
                'placeholder'  => 'Ej: @maria.style',
                'typography'   => ['heading' => 'Playfair Display', 'body' => 'Manrope'],
                'is_active'    => true,
                'sort_order'   => 0,
                'theme_colors' => [
                    'surface'          => '#f9f9fb',
                    'surface_low'      => '#f2f4f7',
                    'surface_lowest'   => '#ffffff',
                    'surface_high'     => '#e4e7ec',
                    'on_surface'       => '#2d3338',
                    'on_surface_muted' => '#6b7280',
                    'secondary'        => '#e9e1dd',
                    'tertiary'         => '#6f5d37',
                    'outline'          => '#d0ccc8',
                ],
                'defaults' => [
                    'hero' => [
                        'photo' => '',
                        'name'  => '@tuusuario',
                        'bio'   => 'Creadora de contenido · Moda & Lifestyle',
                    ],
                    'links' => [
                        'items' => [
                            ['title' => 'Mi último post',     'url' => '#'],
                            ['title' => 'Mis recomendaciones','url' => '#'],
                            ['title' => 'Trabaja conmigo',    'url' => '#'],
                        ],
                    ],
                    'social' => [
                        'instagram' => '',
                        'tiktok'    => '',
                        'youtube'   => '',
                        'twitter'   => '',
                        'twitch'    => '',
                        'pinterest' => '',
                    ],
                ],
            ]
        );
    }

    private function setThemeColors(string $sectorKey, string $variantKey, array $colors): void
    {
        $sector  = CatalogSector::where('key', $sectorKey)->first();
        if (! $sector) return;
        $variant = CatalogVariant::where('sector_id', $sector->id)->where('key', $variantKey)->first();
        if (! $variant) return;
        $variant->update(['theme_colors' => $colors]);
    }
}
