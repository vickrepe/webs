<?php

return [
    'sector'   => 'food',
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
                'headline'    => ['type' => 'text',  'label' => 'Título principal',  'placeholder' => 'Bienvenido a nuestro local'],
                'subheadline' => ['type' => 'text',  'label' => 'Subtítulo',         'placeholder' => 'Cocina casera en el corazón de la ciudad'],
                'cta_text'    => ['type' => 'text',  'label' => 'Texto del botón',   'placeholder' => 'Ver carta'],
                'bg_image'    => ['type' => 'image', 'label' => 'Imagen de fondo',   'placeholder' => '/images/defaults/slider/slider_1.png'],
                'bg_image_2'  => ['type' => 'image', 'label' => 'Imagen de fondo 2', 'placeholder' => '/images/defaults/slider/slider_2.png'],
                'bg_image_3'  => ['type' => 'image', 'label' => 'Imagen de fondo 3', 'placeholder' => '/images/defaults/slider/slider_3.png'],
            ],
        ],

        'about' => [
            'required' => false,
            'label'    => 'Sobre nosotros',
            'fields'   => [
                'title' => ['type' => 'text',     'label' => 'Título',      'placeholder' => 'Nuestra historia'],
                'text'  => ['type' => 'textarea', 'label' => 'Descripción', 'placeholder' => 'Un local con sabor a tradición. Llevamos años sirviendo los mejores platos de la zona.'],
                'image' => ['type' => 'image',    'label' => 'Foto',        'placeholder' => ''],
            ],
        ],

        'menu' => [
            'required'       => true,
            'repeatable'     => true,
            'plan_limit'     => 'services',
            'label'          => 'Carta / Menú',
            'section_fields' => [
                'layout'    => ['type' => 'select', 'label' => 'Diseño',          'options' => ['grid' => 'Tarjetas', 'alternating' => 'Alternado con imagen', 'numbered' => 'Numerado (sin imagen)']],
                'show_more' => ['type' => 'select', 'label' => 'Botón "Ver más"', 'options' => ['0' => 'No mostrar', '1' => 'Mostrar botón']],
            ],
            'fields'         => [
                'name'        => ['type' => 'text',     'label' => 'Nombre del plato',  'placeholder' => 'Menú del día'],
                'price'       => ['type' => 'text',     'label' => 'Precio',            'placeholder' => '10€'],
                'description' => ['type' => 'textarea', 'label' => 'Descripción',       'placeholder' => 'Primer plato, segundo, postre y bebida incluida'],
                'image'       => ['type' => 'image',    'label' => 'Foto (opcional)',   'placeholder' => ''],
            ],
            'placeholder_items' => [
                ['name' => 'Menú del día',       'price' => '10€', 'description' => 'Primer plato, segundo, postre y bebida', 'image' => ''],
                ['name' => 'Tostada con café',   'price' => '3€',  'description' => 'Pan artesano con aceite y tomate',       'image' => ''],
                ['name' => 'Bocadillo especial', 'price' => '5€',  'description' => 'Con jamón serrano y queso curado',       'image' => ''],
            ],
        ],

        'gallery' => [
            'required'       => false,
            'repeatable'     => true,
            'plan_limit'     => 'gallery_photos',
            'label'          => 'Galería',
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
                'caption' => ['type' => 'text',  'label' => 'Pie',   'placeholder' => 'Plato del día'],
            ],
            'placeholder_items' => [
                ['image' => '/images/defaults/cafeteria/photo-1.png', 'caption' => ''],
                ['image' => '/images/defaults/cafeteria/photo-2.png', 'caption' => ''],
                ['image' => '/images/defaults/cafeteria/photo-3.png', 'caption' => ''],
                ['image' => '/images/defaults/cafeteria/photo-4.png', 'caption' => ''],
                ['image' => '/images/defaults/cafeteria/photo-5.png', 'caption' => ''],
                ['image' => '/images/defaults/cafeteria/photo-6.png', 'caption' => ''],
            ],
        ],

        'reviews' => [
            'required'          => false,
            'min_plan'          => 'basic',
            'repeatable'        => true,
            'label'             => 'Reseñas',
            'fields'            => [
                'author' => ['type' => 'text',     'label' => 'Autor',      'placeholder' => 'María López'],
                'text'   => ['type' => 'textarea', 'label' => 'Reseña',     'placeholder' => 'La mejor tortilla de la ciudad. Repetiré seguro.'],
                'rating' => ['type' => 'number',   'label' => 'Puntuación', 'min' => 1, 'max' => 5, 'placeholder' => '5'],
            ],
            'placeholder_items' => [
                ['author' => 'María López',  'text' => 'La mejor tortilla de la ciudad. Repetiré seguro.', 'rating' => 5],
                ['author' => 'Carlos Ruiz',  'text' => 'Ambiente familiar y precios muy razonables.',       'rating' => 5],
            ],
        ],

        'contact' => [
            'required' => true,
            'label'    => 'Contacto',
            'fields'   => [
                'phone'   => ['type' => 'text',     'label' => 'Teléfono', 'placeholder' => '+34 600 000 000'],
                'email'   => ['type' => 'text',     'label' => 'Email',    'placeholder' => 'hola@micafeteria.com'],
                'address' => ['type' => 'text',     'label' => 'Dirección','placeholder' => 'Calle Mayor 1, Madrid'],
                'hours'   => ['type' => 'textarea', 'label' => 'Horario',  'placeholder' => "Lun–Vie: 8:00–20:00\nSáb: 9:00–15:00\nDom: Cerrado"],
            ],
        ],

        'blog' => [
            'required'     => false,
            'label'        => 'Blog',
            'blog_section' => true,
            'fields'       => [],
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
                'message' => ['type' => 'text', 'label' => 'Mensaje predefinido', 'placeholder' => '¡Hola! Quiero hacer una reserva.'],
            ],
        ],

    ],
];
