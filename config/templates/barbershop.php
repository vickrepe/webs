<?php

return [
    'sector'   => 'barbershop',
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
            'required' => true,
            'label'    => 'Portada',
            'fields'   => [
                'headline'    => ['type' => 'text',  'label' => 'Título principal',  'placeholder' => 'El mejor corte de tu vida'],
                'subheadline' => ['type' => 'text',  'label' => 'Subtítulo',         'placeholder' => 'Barbería clásica en el corazón de la ciudad'],
                'cta_text'    => ['type' => 'text',  'label' => 'Texto del botón',   'placeholder' => 'Reserva ahora'],
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
                'text'  => ['type' => 'textarea', 'label' => 'Descripción', 'placeholder' => 'Llevamos más de 10 años ofreciendo los mejores cortes de la ciudad con técnicas tradicionales y modernas.'],
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
                'name'        => ['type' => 'text',     'label' => 'Nombre',          'placeholder' => 'Corte clásico'],
                'price'       => ['type' => 'text',     'label' => 'Precio',          'placeholder' => '15€'],
                'description' => ['type' => 'textarea', 'label' => 'Descripción',     'placeholder' => 'Corte tradicional con acabado perfecto'],
                'image'       => ['type' => 'image',    'label' => 'Foto (opcional)', 'placeholder' => ''],
            ],
            'placeholder_items' => [
                ['name' => 'Corte clásico',  'price' => '15€', 'description' => 'Corte tradicional con acabado perfecto', 'image' => '/images/defaults/services/serv-1.png'],
                ['name' => 'Barba completa', 'price' => '10€', 'description' => 'Perfilado y arreglo de barba',           'image' => '/images/defaults/services/serv-2.png'],
                ['name' => 'Corte + Barba',  'price' => '22€', 'description' => 'Servicio completo',                      'image' => '/images/defaults/services/serv-3.png'],
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
                'image'   => ['type' => 'image', 'label' => 'Foto',    'placeholder' => ''],
                'caption' => ['type' => 'text',  'label' => 'Pie',     'placeholder' => 'Corte del mes'],
            ],
            'placeholder_items' => [
                ['image' => '/images/defaults/gallery/photo-1.png', 'caption' => ''],
                ['image' => '/images/defaults/gallery/photo-2.png', 'caption' => ''],
                ['image' => '/images/defaults/gallery/photo-3.png', 'caption' => ''],
                ['image' => '/images/defaults/gallery/photo-4.png', 'caption' => ''],
                ['image' => '/images/defaults/gallery/photo-5.png', 'caption' => ''],
                ['image' => '/images/defaults/gallery/photo-6.png', 'caption' => ''],
                ['image' => '/images/defaults/gallery/photo-7.png', 'caption' => ''],
                ['image' => '/images/defaults/gallery/photo-8.png', 'caption' => ''],
                ['image' => '/images/defaults/gallery/photo-9.png', 'caption' => ''],
            ],
        ],

        'team' => [
            'required'          => false,
            'repeatable'        => true,
            'plan_limit'        => 'team_members',
            'label'             => 'Equipo',
            'fields'            => [
                'name'  => ['type' => 'text',  'label' => 'Nombre', 'placeholder' => 'Carlos Ruiz'],
                'role'  => ['type' => 'text',  'label' => 'Rol',    'placeholder' => 'Barbero senior'],
                'photo' => ['type' => 'image', 'label' => 'Foto',   'placeholder' => ''],
            ],
            'placeholder_items' => [
                ['name' => 'Carlos López', 'role' => 'Barbero Senior', 'photo' => '/images/defaults/team/team_photo_1.png'],
                ['name' => 'Ana Martínez', 'role' => 'Estilista',      'photo' => '/images/defaults/team/team_photo_2.png'],
                ['name' => 'David Ruiz',   'role' => 'Barbero',        'photo' => '/images/defaults/team/team_photo_3.png'],
            ],
        ],

        'reviews' => [
            'required'          => false,
            'min_plan'          => 'basic',
            'repeatable'        => true,
            'label'             => 'Reseñas',
            'fields'            => [
                'author' => ['type' => 'text',     'label' => 'Autor',    'placeholder' => 'Juan García'],
                'text'   => ['type' => 'textarea', 'label' => 'Reseña',   'placeholder' => 'Increíble servicio, siempre salgo con un corte perfecto.'],
                'rating' => ['type' => 'number',   'label' => 'Puntuación', 'min' => 1, 'max' => 5, 'placeholder' => '5'],
            ],
            'placeholder_items' => [
                ['author' => 'Juan García',  'text' => 'Increíble servicio, siempre salgo con un corte perfecto.', 'rating' => 5],
                ['author' => 'Pedro Martín', 'text' => 'El mejor sitio para una barba de diez.',                   'rating' => 5],
            ],
        ],

        'contact' => [
            'required' => true,
            'label'    => 'Contacto',
            'fields'   => [
                'phone'   => ['type' => 'text',     'label' => 'Teléfono', 'placeholder' => '+34 600 000 000'],
                'email'   => ['type' => 'text',     'label' => 'Email',    'placeholder' => 'hola@mibarberia.com'],
                'address' => ['type' => 'text',     'label' => 'Dirección','placeholder' => 'Calle Mayor 1, Madrid'],
                'hours'   => ['type' => 'textarea', 'label' => 'Horario',  'placeholder' => "Lun–Vie: 9:00–20:00\nSáb: 9:00–15:00\nDom: Cerrado"],
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
                'instagram' => ['type' => 'text', 'label' => 'Instagram',    'placeholder' => 'https://instagram.com/tunegocio'],
                'facebook'  => ['type' => 'text', 'label' => 'Facebook',     'placeholder' => 'https://facebook.com/tunegocio'],
                'tiktok'    => ['type' => 'text', 'label' => 'TikTok',       'placeholder' => 'https://tiktok.com/@tunegocio'],
                'youtube'   => ['type' => 'text', 'label' => 'YouTube',      'placeholder' => 'https://youtube.com/@tunegocio'],
                'x'         => ['type' => 'text', 'label' => 'X (Twitter)',  'placeholder' => 'https://x.com/tunegocio'],
            ],
        ],

        'whatsapp_cta' => [
            'required' => false,
            'label'    => 'Botón WhatsApp',
            'fields'   => [
                'phone'   => ['type' => 'text', 'label' => 'Número WhatsApp',    'placeholder' => '+34600000000'],
                'message' => ['type' => 'text', 'label' => 'Mensaje predefinido','placeholder' => '¡Hola! Quiero reservar una cita.'],
            ],
        ],

    ],
];
