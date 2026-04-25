<?php

return [
    'sector'   => 'services_local',
    'sections' => [

        'nav' => [
            'required' => true,
            'nav_only' => true,
            'label'    => 'Menú de navegación',
            'fields'   => [
                'logo_display' => ['type' => 'select', 'label' => 'Logo', 'options' => [
                    'image'  => 'Mostrar imagen',
                    'text'   => 'Solo texto',
                    'hidden' => 'Ocultar',
                ], 'placeholder' => 'image'],
                'cta_enabled' => ['type' => 'select', 'label' => 'Botón de llamada a la acción', 'options' => [
                    '1' => 'Sí, mostrar',
                    '0' => 'No mostrar',
                ], 'placeholder' => '1'],
                'cta_text' => ['type' => 'text', 'label' => 'Texto del botón', 'placeholder' => 'Reservar ahora'],
                'cta_url'  => ['type' => 'text', 'label' => 'URL del botón',   'placeholder' => '#contact'],
            ],
        ],

        'hero' => [
            'required'       => true,
            'label'          => 'Portada',
            'section_fields' => [
                'layout' => ['type' => 'select', 'label' => 'Diseño del hero', 'options' => [
                    'fullscreen' => 'Pantalla completa',
                    'split'      => 'División (texto + imagen)',
                ]],
            ],
            'fields'   => [
                'headline'    => ['type' => 'text',  'label' => 'Título principal',  'placeholder' => 'Profesionales a tu servicio'],
                'subheadline' => ['type' => 'text',  'label' => 'Subtítulo',         'placeholder' => 'Presupuesto sin compromiso'],
                'cta_text'    => ['type' => 'text',  'label' => 'Texto del botón',   'placeholder' => 'Pedir presupuesto'],
                'bg_image'    => ['type' => 'image', 'label' => 'Imagen de fondo',   'placeholder' => '/images/defaults/slider/slider_1.png'],
                'bg_image_2'  => ['type' => 'image', 'label' => 'Imagen de fondo 2', 'placeholder' => '/images/defaults/slider/slider_2.png'],
                'bg_image_3'  => ['type' => 'image', 'label' => 'Imagen de fondo 3', 'placeholder' => '/images/defaults/slider/slider_3.png'],
            ],
        ],

        'about' => [
            'required' => false,
            'label'    => 'Sobre nosotros',
            'fields'   => [
                'title' => ['type' => 'text',     'label' => 'Título',      'placeholder' => 'Quiénes somos'],
                'text'  => ['type' => 'textarea', 'label' => 'Descripción', 'placeholder' => 'Más de 15 años de experiencia en el sector. Trabajamos con garantía y materiales de primera calidad.'],
                'image' => ['type' => 'image',    'label' => 'Foto',        'placeholder' => ''],
            ],
        ],

        'services' => [
            'required'       => true,
            'repeatable'     => true,
            'plan_limit'     => 'services',
            'label'          => 'Servicios',
            'section_fields' => [
                'layout'    => ['type' => 'select', 'label' => 'Diseño',          'options' => ['grid' => 'Tarjetas', 'alternating' => 'Alternado con imagen']],
                'show_more' => ['type' => 'select', 'label' => 'Botón "Ver más"', 'options' => ['0' => 'No mostrar', '1' => 'Mostrar botón']],
            ],
            'fields'         => [
                'name'        => ['type' => 'text',     'label' => 'Nombre del servicio', 'placeholder' => 'Instalación eléctrica'],
                'price'       => ['type' => 'text',     'label' => 'Precio orientativo',  'placeholder' => 'Desde 50€'],
                'description' => ['type' => 'textarea', 'label' => 'Descripción',         'placeholder' => 'Instalación completa con certificado de calidad'],
                'image'       => ['type' => 'image',    'label' => 'Foto (opcional)',      'placeholder' => ''],
            ],
            'placeholder_items' => [
                ['name' => 'Instalación',  'price' => 'Desde 50€',  'description' => 'Montaje e instalación profesional',    'image' => ''],
                ['name' => 'Reparación',   'price' => 'Desde 30€',  'description' => 'Diagnóstico y reparación en el acto',  'image' => ''],
                ['name' => 'Mantenimiento','price' => 'Desde 40€',  'description' => 'Revisión periódica y puesta a punto',  'image' => ''],
            ],
        ],

        'gallery' => [
            'required'       => false,
            'repeatable'     => true,
            'plan_limit'     => 'gallery_photos',
            'label'          => 'Trabajos realizados',
            'section_fields' => [
                'layout'    => ['type' => 'select', 'label' => 'Diseño de galería', 'options' => [
                    'grid'    => 'Cuadrícula',
                    'masonry' => 'Masonry',
                    'bento'   => 'Bento',
                ]],
                'show_more' => ['type' => 'select', 'label' => 'Botón "Ver más"', 'options' => ['0' => 'No mostrar', '1' => 'Mostrar botón']],
            ],
            'fields'     => [
                'image'   => ['type' => 'image', 'label' => 'Foto',  'placeholder' => ''],
                'caption' => ['type' => 'text',  'label' => 'Pie',   'placeholder' => 'Instalación terminada'],
            ],
            'placeholder_items' => [
                ['image' => '/images/defaults/albanileria/photo-1.png', 'caption' => ''],
                ['image' => '/images/defaults/albanileria/photo-2.png', 'caption' => ''],
                ['image' => '/images/defaults/albanileria/photo-3.png', 'caption' => ''],
                ['image' => '/images/defaults/albanileria/photo-4.png', 'caption' => ''],
                ['image' => '/images/defaults/albanileria/photo-5.png', 'caption' => ''],
                ['image' => '/images/defaults/albanileria/photo-6.png', 'caption' => ''],
            ],
        ],

        'stats' => [
            'required'          => false,
            'label'             => 'Estadísticas',
            'repeatable'        => true,
            'section_fields'    => [
                'title' => ['type' => 'text', 'label' => 'Título de sección', 'placeholder' => 'Nuestros números'],
            ],
            'fields'            => [
                'number' => ['type' => 'text', 'label' => 'Cifra',    'placeholder' => '500+'],
                'label'  => ['type' => 'text', 'label' => 'Etiqueta', 'placeholder' => 'Proyectos realizados'],
            ],
            'placeholder_items' => [
                ['number' => '500+', 'label' => 'Proyectos'],
                ['number' => '15',   'label' => 'Años de experiencia'],
                ['number' => '98%',  'label' => 'Clientes satisfechos'],
                ['number' => '24h',  'label' => 'Respuesta garantizada'],
            ],
        ],

        'reviews' => [
            'required'          => false,
            'min_plan'          => 'basic',
            'repeatable'        => true,
            'label'             => 'Reseñas',
            'fields'            => [
                'author' => ['type' => 'text',     'label' => 'Autor',      'placeholder' => 'Antonio García'],
                'text'   => ['type' => 'textarea', 'label' => 'Reseña',     'placeholder' => 'Trabajo impecable y en el tiempo acordado. Muy recomendable.'],
                'rating' => ['type' => 'number',   'label' => 'Puntuación', 'min' => 1, 'max' => 5, 'placeholder' => '5'],
            ],
            'placeholder_items' => [
                ['author' => 'Antonio García', 'text' => 'Trabajo impecable y en el tiempo acordado. Muy recomendable.', 'rating' => 5],
                ['author' => 'Lucía Pérez',    'text' => 'Rápidos, limpios y profesionales. Sin duda volveré a llamar.', 'rating' => 5],
            ],
        ],

        'contact' => [
            'required' => true,
            'label'    => 'Contacto',
            'fields'   => [
                'phone'   => ['type' => 'text',     'label' => 'Teléfono', 'placeholder' => '+34 600 000 000'],
                'email'   => ['type' => 'text',     'label' => 'Email',    'placeholder' => 'info@miprofesional.com'],
                'address' => ['type' => 'text',     'label' => 'Zona de trabajo', 'placeholder' => 'Madrid y alrededores'],
                'hours'   => ['type' => 'textarea', 'label' => 'Horario', 'placeholder' => "Lun–Vie: 8:00–19:00\nSáb: 9:00–14:00\nDom: Urgencias"],
            ],
        ],

        'booking' => [
            'required'        => false,
            'label'           => 'Reservas / Citas',
            'fields'          => [],
            'booking_section' => true,
        ],

        'social' => [
            'required'          => false,
            'footer_only'       => true,
            'toggleable_fields' => true,
            'label'             => 'Redes sociales',
            'fields'      => [
                'instagram' => ['type' => 'text', 'label' => 'Instagram',   'placeholder' => 'https://instagram.com/tunegocio'],
                'facebook'  => ['type' => 'text', 'label' => 'Facebook',    'placeholder' => 'https://facebook.com/tunegocio'],
                'tiktok'    => ['type' => 'text', 'label' => 'TikTok',      'placeholder' => 'https://tiktok.com/@tunegocio'],
                'youtube'   => ['type' => 'text', 'label' => 'YouTube',     'placeholder' => 'https://youtube.com/@tunegocio'],
                'x'         => ['type' => 'text', 'label' => 'X (Twitter)', 'placeholder' => 'https://x.com/tunegocio'],
            ],
        ],

        'whatsapp_cta' => [
            'required' => false,
            'label'    => 'Botón WhatsApp',
            'fields'   => [
                'phone'   => ['type' => 'text', 'label' => 'Número WhatsApp',     'placeholder' => '+34600000000'],
                'message' => ['type' => 'text', 'label' => 'Mensaje predefinido', 'placeholder' => '¡Hola! Necesito un presupuesto.'],
            ],
        ],

    ],
];
