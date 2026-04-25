<?php

return [
    'sector'   => 'clothing',
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
                'headline'    => ['type' => 'text',  'label' => 'Título principal',  'placeholder' => 'Nueva colección'],
                'subheadline' => ['type' => 'text',  'label' => 'Subtítulo',         'placeholder' => 'Moda con personalidad, entrega en 24h'],
                'cta_text'    => ['type' => 'text',  'label' => 'Texto del botón',   'placeholder' => 'Ver colección'],
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
                'text'  => ['type' => 'textarea', 'label' => 'Descripción', 'placeholder' => 'Creamos prendas únicas con materiales sostenibles. Cada pieza es diseñada con cuidado y pasión.'],
                'image' => ['type' => 'image',    'label' => 'Foto',        'placeholder' => ''],
            ],
        ],

        'products' => [
            'required'       => true,
            'repeatable'     => true,
            'plan_limit'     => 'services',
            'label'          => 'Productos',
            'section_fields' => [
                'layout'    => ['type' => 'select', 'label' => 'Diseño',          'options' => ['grid' => 'Tarjetas', 'alternating' => 'Alternado con imagen', 'cols_4' => '4 columnas']],
                'show_more' => ['type' => 'select', 'label' => 'Botón "Ver más"', 'options' => ['0' => 'No mostrar', '1' => 'Mostrar botón']],
            ],
            'fields'         => [
                'name'        => ['type' => 'text',     'label' => 'Nombre del producto', 'placeholder' => 'Camiseta básica'],
                'price'       => ['type' => 'text',     'label' => 'Precio',              'placeholder' => '29€'],
                'description' => ['type' => 'textarea', 'label' => 'Descripción',         'placeholder' => '100% algodón orgánico. Tallas S–XL.'],
                'image'       => ['type' => 'image',    'label' => 'Foto del producto',   'placeholder' => ''],
            ],
            'placeholder_items' => [
                ['name' => 'Camiseta básica',  'price' => '29€', 'description' => '100% algodón orgánico. Tallas S–XL.',          'image' => ''],
                ['name' => 'Pantalón chino',   'price' => '49€', 'description' => 'Corte slim. Disponible en 4 colores.',          'image' => ''],
                ['name' => 'Sudadera premium', 'price' => '65€', 'description' => 'Interior afelpado. Unisex. Tallas XS–XXL.',     'image' => ''],
            ],
        ],

        'gallery' => [
            'required'       => false,
            'repeatable'     => true,
            'plan_limit'     => 'gallery_photos',
            'label'          => 'Lookbook',
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
                'caption' => ['type' => 'text',  'label' => 'Pie',   'placeholder' => 'Look de temporada'],
            ],
            'placeholder_items' => [
                ['image' => '/images/defaults/ropa/photo-1.png', 'caption' => ''],
                ['image' => '/images/defaults/ropa/photo-2.png', 'caption' => ''],
                ['image' => '/images/defaults/ropa/photo-3.png', 'caption' => ''],
                ['image' => '/images/defaults/ropa/photo-4.png', 'caption' => ''],
                ['image' => '/images/defaults/ropa/photo-5.png', 'caption' => ''],
                ['image' => '/images/defaults/ropa/photo-6.png', 'caption' => ''],
            ],
        ],

        'reviews' => [
            'required'          => false,
            'min_plan'          => 'basic',
            'repeatable'        => true,
            'label'             => 'Reseñas',
            'fields'            => [
                'author' => ['type' => 'text',     'label' => 'Autor',      'placeholder' => 'Sara Gómez'],
                'text'   => ['type' => 'textarea', 'label' => 'Reseña',     'placeholder' => 'La calidad de las telas es increíble. Mis pedidos siempre llegan antes de lo previsto.'],
                'rating' => ['type' => 'number',   'label' => 'Puntuación', 'min' => 1, 'max' => 5, 'placeholder' => '5'],
            ],
            'placeholder_items' => [
                ['author' => 'Sara Gómez',   'text' => 'La calidad de las telas es increíble. Siempre llegan antes de lo previsto.', 'rating' => 5],
                ['author' => 'Pablo Torres', 'text' => 'Diseños únicos y atención al cliente perfecta. 100% recomendable.',          'rating' => 5],
            ],
        ],

        'contact' => [
            'required' => true,
            'label'    => 'Contacto',
            'fields'   => [
                'phone'   => ['type' => 'text',     'label' => 'Teléfono', 'placeholder' => '+34 600 000 000'],
                'email'   => ['type' => 'text',     'label' => 'Email',    'placeholder' => 'hola@mitienda.com'],
                'address' => ['type' => 'text',     'label' => 'Dirección (almacén / sede)', 'placeholder' => 'Madrid, España'],
                'hours'   => ['type' => 'textarea', 'label' => 'Horario de atención',        'placeholder' => "Lun–Vie: 9:00–18:00\nPedidos online: 24/7"],
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
                'instagram' => ['type' => 'text', 'label' => 'Instagram',   'placeholder' => 'https://instagram.com/tutienda'],
                'facebook'  => ['type' => 'text', 'label' => 'Facebook',    'placeholder' => 'https://facebook.com/tutienda'],
                'tiktok'    => ['type' => 'text', 'label' => 'TikTok',      'placeholder' => 'https://tiktok.com/@tutienda'],
                'youtube'   => ['type' => 'text', 'label' => 'YouTube',     'placeholder' => 'https://youtube.com/@tutienda'],
                'x'         => ['type' => 'text', 'label' => 'X (Twitter)', 'placeholder' => 'https://x.com/tutienda'],
            ],
        ],

        'whatsapp_cta' => [
            'required' => false,
            'label'    => 'Botón WhatsApp',
            'fields'   => [
                'phone'   => ['type' => 'text', 'label' => 'Número WhatsApp',     'placeholder' => '+34600000000'],
                'message' => ['type' => 'text', 'label' => 'Mensaje predefinido', 'placeholder' => '¡Hola! Quiero hacer un pedido.'],
            ],
        ],

    ],
];
