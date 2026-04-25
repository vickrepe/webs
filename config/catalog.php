<?php

return [

    // ── Peluquería ────────────────────────────────────────────────────────────
    'peluqueria' => [
        'label'    => 'Peluquería',
        'icon'     => '✂️',
        'template' => 'barbershop',
        'variants' => [

            'barbershop' => [
                'label'       => 'Barbería',
                'color'       => '#1a1a1a',
                'placeholder' => 'Ej: Barbería Don Carlos',
                'typography'  => ['heading' => 'Oswald', 'body' => 'Lato'],
                'defaults'    => [
                    'hero' => [
                        'bg_image'    => '/images/defaults/barbershop/slider_1.png',
                        'bg_image_2'  => '/images/defaults/barbershop/slider_2.png',
                        'bg_image_3'  => '/images/defaults/barbershop/slider_3.png',
                        'subheadline' => 'Barbería clásica en el corazón de la ciudad',
                        'cta_text'    => 'Reserva ahora',
                    ],
                    'about' => [
                        'title' => 'Nuestra historia',
                        'text'  => 'Llevamos más de 10 años ofreciendo los mejores cortes con técnicas tradicionales y modernas.',
                        'image' => '',
                    ],
                    'services' => [
                        'items' => [
                            ['name' => 'Corte clásico',  'price' => '15€', 'description' => 'Corte tradicional con acabado perfecto',  'image' => '/images/defaults/services/serv-1.png'],
                            ['name' => 'Barba completa', 'price' => '10€', 'description' => 'Perfilado y arreglo de barba',             'image' => '/images/defaults/services/serv-2.png'],
                            ['name' => 'Corte + Barba',  'price' => '22€', 'description' => 'Servicio completo',                        'image' => '/images/defaults/services/serv-3.png'],
                        ],
                    ],
                    'gallery' => [
                        'items' => [
                            ['image' => '/images/defaults/gallery/photo-1.png', 'caption' => ''],
                            ['image' => '/images/defaults/gallery/photo-2.png', 'caption' => ''],
                            ['image' => '/images/defaults/gallery/photo-3.png', 'caption' => ''],
                            ['image' => '/images/defaults/gallery/photo-4.png', 'caption' => ''],
                            ['image' => '/images/defaults/gallery/photo-5.png', 'caption' => ''],
                            ['image' => '/images/defaults/gallery/photo-6.png', 'caption' => ''],
                        ],
                    ],
                    'team' => [
                        'items' => [
                            ['name' => 'Carlos López', 'role' => 'Barbero Senior',  'photo' => '/images/defaults/team/team_photo_1.png'],
                            ['name' => 'Ana Martínez', 'role' => 'Estilista',       'photo' => '/images/defaults/team/team_photo_2.png'],
                            ['name' => 'David Ruiz',   'role' => 'Barbero',         'photo' => '/images/defaults/team/team_photo_3.png'],
                        ],
                    ],
                ],
            ],

            'salon' => [
                'label'       => 'Salón',
                'color'       => '#c8a96e',
                'placeholder' => 'Ej: Salón Elegance',
                'typography'  => ['heading' => 'Playfair Display', 'body' => 'Open Sans'],
                'defaults'    => [
                    'hero' => [
                        'bg_image'    => '/images/defaults/salon/slider_1.png',
                        'bg_image_2'  => '/images/defaults/salon/slider_2.png',
                        'bg_image_3'  => '/images/defaults/salon/slider_3.png',
                        'subheadline' => 'Tu salón de belleza de confianza',
                        'cta_text'    => 'Pide tu cita',
                    ],
                    'about' => [
                        'title' => 'Sobre nosotros',
                        'text'  => 'Somos un equipo apasionado por la belleza y el cuidado personal. Cada cliente es único.',
                        'image' => '',
                    ],
                    'services' => [
                        'items' => [
                            ['name' => 'Corte y peinado', 'price' => '25€', 'description' => 'Corte personalizado y secado profesional', 'image' => '/images/defaults/salon/serv-1.png'],
                            ['name' => 'Tinte',           'price' => '45€', 'description' => 'Coloración con productos de alta gama',    'image' => '/images/defaults/salon/serv-2.png'],
                            ['name' => 'Mechas',          'price' => '60€', 'description' => 'Mechas y balayage a medida',               'image' => '/images/defaults/salon/serv-3.png'],
                        ],
                    ],
                    'gallery' => [
                        'items' => [
                            ['image' => '/images/defaults/salon/photo-1.png', 'caption' => ''],
                            ['image' => '/images/defaults/salon/photo-2.png', 'caption' => ''],
                            ['image' => '/images/defaults/salon/photo-3.png', 'caption' => ''],
                            ['image' => '/images/defaults/salon/photo-4.png', 'caption' => ''],
                            ['image' => '/images/defaults/salon/photo-5.png', 'caption' => ''],
                            ['image' => '/images/defaults/salon/photo-6.png', 'caption' => ''],
                        ],
                    ],
                    'team' => [
                        'items' => [
                            ['name' => 'María García',  'role' => 'Estilista Principal', 'photo' => '/images/defaults/salon/team_1.png'],
                            ['name' => 'Laura Sánchez', 'role' => 'Colorista',           'photo' => '/images/defaults/salon/team_2.png'],
                            ['name' => 'Sofía Ruiz',    'role' => 'Especialista',        'photo' => '/images/defaults/salon/team_3.png'],
                        ],
                    ],
                ],
            ],

        ],
    ],

    // ── Comida ────────────────────────────────────────────────────────────────
    'comida' => [
        'label'    => 'Comida',
        'icon'     => '🍽️',
        'template' => 'food',
        'variants' => [

            'cafeteria' => [
                'label'       => 'Cafetería',
                'color'       => '#c8792a',
                'placeholder' => 'Ej: Cafetería El Rincón',
                'typography'  => ['heading' => 'Montserrat', 'body' => 'Open Sans'],
                'defaults'    => [
                    'hero' => [
                        'bg_image'    => '/images/defaults/cafeteria/slider_1.png',
                        'bg_image_2'  => '/images/defaults/cafeteria/slider_2.png',
                        'bg_image_3'  => '/images/defaults/cafeteria/slider_3.png',
                        'subheadline' => 'El mejor desayuno de la ciudad',
                        'cta_text'    => 'Ver carta',
                    ],
                    'about' => [
                        'title' => 'Nuestra historia',
                        'text'  => 'Un local con sabor a tradición. Llevamos años sirviendo los mejores desayunos y menús de la zona.',
                        'image' => '',
                    ],
                    'menu' => [
                        'items' => [
                            ['name' => 'Menú del día',       'price' => '10€', 'description' => 'Primer plato, segundo, postre y bebida', 'image' => '/images/defaults/cafeteria/serv-1.png'],
                            ['name' => 'Tostada con café',   'price' => '3€',  'description' => 'Pan artesano con aceite y tomate',       'image' => '/images/defaults/cafeteria/serv-2.png'],
                            ['name' => 'Bocadillo especial', 'price' => '5€',  'description' => 'Con jamón serrano y queso curado',       'image' => '/images/defaults/cafeteria/serv-3.png'],
                        ],
                    ],
                    'gallery' => [
                        'items' => [
                            ['image' => '/images/defaults/cafeteria/photo-1.png', 'caption' => ''],
                            ['image' => '/images/defaults/cafeteria/photo-2.png', 'caption' => ''],
                            ['image' => '/images/defaults/cafeteria/photo-3.png', 'caption' => ''],
                            ['image' => '/images/defaults/cafeteria/photo-4.png', 'caption' => ''],
                            ['image' => '/images/defaults/cafeteria/photo-5.png', 'caption' => ''],
                            ['image' => '/images/defaults/cafeteria/photo-6.png', 'caption' => ''],
                        ],
                    ],
                ],
            ],

            'restaurante' => [
                'label'       => 'Restaurante',
                'color'       => '#1a1a1a',
                'placeholder' => 'Ej: Restaurante La Plaza',
                'typography'  => ['heading' => 'Playfair Display', 'body' => 'Lato'],
                'defaults'    => [
                    'hero' => [
                        'bg_image'    => '/images/defaults/restaurante/slider_1.png',
                        'bg_image_2'  => '/images/defaults/restaurante/slider_2.png',
                        'bg_image_3'  => '/images/defaults/restaurante/slider_3.png',
                        'subheadline' => 'Una experiencia gastronómica única',
                        'cta_text'    => 'Reservar mesa',
                    ],
                    'about' => [
                        'title' => 'Sobre nosotros',
                        'text'  => 'Cocina de autor con los mejores productos de temporada. Una experiencia gastronómica que no olvidarás.',
                        'image' => '',
                    ],
                    'menu' => [
                        'items' => [
                            ['name' => 'Entrantes',          'price' => '12€', 'description' => 'Selección de entrantes de temporada',          'image' => '/images/defaults/restaurante/serv-1.png'],
                            ['name' => 'Plato principal',    'price' => '22€', 'description' => 'Carnes y pescados a la brasa',                  'image' => '/images/defaults/restaurante/serv-2.png'],
                            ['name' => 'Menú degustación',   'price' => '45€', 'description' => '5 pasos con maridaje incluido',                 'image' => '/images/defaults/restaurante/serv-3.png'],
                        ],
                    ],
                    'gallery' => [
                        'items' => [
                            ['image' => '/images/defaults/restaurante/photo-1.png', 'caption' => ''],
                            ['image' => '/images/defaults/restaurante/photo-2.png', 'caption' => ''],
                            ['image' => '/images/defaults/restaurante/photo-3.png', 'caption' => ''],
                            ['image' => '/images/defaults/restaurante/photo-4.png', 'caption' => ''],
                            ['image' => '/images/defaults/restaurante/photo-5.png', 'caption' => ''],
                            ['image' => '/images/defaults/restaurante/photo-6.png', 'caption' => ''],
                        ],
                    ],
                ],
            ],

        ],
    ],

    // ── Servicios ─────────────────────────────────────────────────────────────
    'servicios' => [
        'label'    => 'Servicios',
        'icon'     => '🔧',
        'template' => 'services_local',
        'variants' => [

            'albanileria' => [
                'label'       => 'Albañilería',
                'color'       => '#5c4033',
                'placeholder' => 'Ej: Reformas García',
                'typography'  => ['heading' => 'Oswald', 'body' => 'Roboto'],
                'defaults'    => [
                    'hero' => [
                        'bg_image'    => '/images/defaults/albanileria/slider_1.png',
                        'bg_image_2'  => '/images/defaults/albanileria/slider_2.png',
                        'bg_image_3'  => '/images/defaults/albanileria/slider_3.png',
                        'subheadline' => 'Reformas y construcción con garantía',
                        'cta_text'    => 'Pedir presupuesto',
                    ],
                    'about' => [
                        'title' => 'Quiénes somos',
                        'text'  => 'Más de 15 años reformando hogares. Trabajamos con materiales de primera calidad y plazos cumplidos.',
                        'image' => '',
                    ],
                    'services' => [
                        'items' => [
                            ['name' => 'Reformas integrales', 'price' => 'Presupuesto',  'description' => 'Cocinas, baños y espacios completos',  'image' => '/images/defaults/albanileria/serv-1.png'],
                            ['name' => 'Alicatado',           'price' => 'Desde 20€/m²', 'description' => 'Suelos, paredes y exteriores',         'image' => '/images/defaults/albanileria/serv-2.png'],
                            ['name' => 'Tabiquería',          'price' => 'Desde 30€/m²', 'description' => 'Pladur, ladrillo y obra nueva',        'image' => '/images/defaults/albanileria/serv-3.png'],
                        ],
                    ],
                    'gallery' => [
                        'items' => [
                            ['image' => '/images/defaults/albanileria/photo-1.png', 'caption' => ''],
                            ['image' => '/images/defaults/albanileria/photo-2.png', 'caption' => ''],
                            ['image' => '/images/defaults/albanileria/photo-3.png', 'caption' => ''],
                            ['image' => '/images/defaults/albanileria/photo-4.png', 'caption' => ''],
                            ['image' => '/images/defaults/albanileria/photo-5.png', 'caption' => ''],
                            ['image' => '/images/defaults/albanileria/photo-6.png', 'caption' => ''],
                        ],
                    ],
                ],
            ],

            'electricista' => [
                'label'       => 'Electricista',
                'color'       => '#e6a817',
                'placeholder' => 'Ej: Electricidad Ruiz',
                'typography'  => ['heading' => 'Montserrat', 'body' => 'Lato'],
                'defaults'    => [
                    'hero' => [
                        'bg_image'    => '/images/defaults/electricista/slider_1.png',
                        'bg_image_2'  => '/images/defaults/electricista/slider_2.png',
                        'bg_image_3'  => '/images/defaults/electricista/slider_3.png',
                        'subheadline' => 'Instalaciones eléctricas con certificado',
                        'cta_text'    => 'Pedir presupuesto',
                    ],
                    'about' => [
                        'title' => 'Quiénes somos',
                        'text'  => 'Electricistas certificados con más de 10 años de experiencia en instalaciones residenciales e industriales.',
                        'image' => '',
                    ],
                    'services' => [
                        'items' => [
                            ['name' => 'Instalación eléctrica', 'price' => 'Desde 50€',  'description' => 'Cuadros, circuitos y puntos de luz',   'image' => '/images/defaults/electricista/serv-1.png'],
                            ['name' => 'Reparación de averías', 'price' => 'Desde 35€',  'description' => 'Diagnóstico y reparación en el acto',   'image' => '/images/defaults/electricista/serv-2.png'],
                            ['name' => 'Domótica',              'price' => 'Presupuesto', 'description' => 'Automatización del hogar y oficina',    'image' => '/images/defaults/electricista/serv-3.png'],
                        ],
                    ],
                    'gallery' => [
                        'items' => [
                            ['image' => '/images/defaults/electricista/photo-1.png', 'caption' => ''],
                            ['image' => '/images/defaults/electricista/photo-2.png', 'caption' => ''],
                            ['image' => '/images/defaults/electricista/photo-3.png', 'caption' => ''],
                            ['image' => '/images/defaults/electricista/photo-4.png', 'caption' => ''],
                            ['image' => '/images/defaults/electricista/photo-5.png', 'caption' => ''],
                            ['image' => '/images/defaults/electricista/photo-6.png', 'caption' => ''],
                        ],
                    ],
                ],
            ],

            'instalador_aires' => [
                'label'       => 'Instalador de aires',
                'color'       => '#0077b6',
                'placeholder' => 'Ej: Clima Total',
                'typography'  => ['heading' => 'Roboto', 'body' => 'Open Sans'],
                'defaults'    => [
                    'hero' => [
                        'bg_image'    => '/images/defaults/aires/slider_1.png',
                        'bg_image_2'  => '/images/defaults/aires/slider_2.png',
                        'bg_image_3'  => '/images/defaults/aires/slider_3.png',
                        'subheadline' => 'Instalación y mantenimiento de climatización',
                        'cta_text'    => 'Pedir presupuesto',
                    ],
                    'about' => [
                        'title' => 'Quiénes somos',
                        'text'  => 'Especialistas en climatización con todas las marcas del mercado. Instalación en 24–48h con garantía.',
                        'image' => '',
                    ],
                    'services' => [
                        'items' => [
                            ['name' => 'Instalación split',  'price' => 'Desde 150€',  'description' => 'Instalación completa con materiales',   'image' => '/images/defaults/aires/serv-1.png'],
                            ['name' => 'Mantenimiento',      'price' => 'Desde 60€',   'description' => 'Limpieza y puesta a punto anual',        'image' => '/images/defaults/aires/serv-2.png'],
                            ['name' => 'Reparación',         'price' => 'Desde 50€',   'description' => 'Diagnóstico y reparación rápida',        'image' => '/images/defaults/aires/serv-3.png'],
                        ],
                    ],
                    'gallery' => [
                        'items' => [
                            ['image' => '/images/defaults/aires/photo-1.png', 'caption' => ''],
                            ['image' => '/images/defaults/aires/photo-2.png', 'caption' => ''],
                            ['image' => '/images/defaults/aires/photo-3.png', 'caption' => ''],
                            ['image' => '/images/defaults/aires/photo-4.png', 'caption' => ''],
                            ['image' => '/images/defaults/aires/photo-5.png', 'caption' => ''],
                            ['image' => '/images/defaults/aires/photo-6.png', 'caption' => ''],
                        ],
                    ],
                ],
            ],

        ],
    ],

    // ── Tienda de ropa ────────────────────────────────────────────────────────
    'ropa' => [
        'label'    => 'Tienda de ropa',
        'icon'     => '👗',
        'template' => 'clothing',
        'variants' => [

            'ropa_online' => [
                'label'       => 'Tienda online',
                'color'       => '#1a1a1a',
                'placeholder' => 'Ej: Moda Bella',
                'typography'  => ['heading' => 'Raleway', 'body' => 'Open Sans'],
                'defaults'    => [
                    'hero' => [
                        'bg_image'    => '/images/defaults/ropa/slider_1.png',
                        'bg_image_2'  => '/images/defaults/ropa/slider_2.png',
                        'bg_image_3'  => '/images/defaults/ropa/slider_3.png',
                        'subheadline' => 'Moda con personalidad, entrega en 24h',
                        'cta_text'    => 'Ver colección',
                    ],
                    'about' => [
                        'title' => 'Nuestra historia',
                        'text'  => 'Creamos prendas únicas con materiales sostenibles. Cada pieza es diseñada con cuidado y pasión por la moda.',
                        'image' => '',
                    ],
                    'products' => [
                        'items' => [
                            ['name' => 'Camiseta básica',  'price' => '29€', 'description' => '100% algodón orgánico. Tallas S–XL.',       'image' => '/images/defaults/ropa/serv-1.png'],
                            ['name' => 'Pantalón chino',   'price' => '49€', 'description' => 'Corte slim. Disponible en 4 colores.',       'image' => '/images/defaults/ropa/serv-2.png'],
                            ['name' => 'Sudadera premium', 'price' => '65€', 'description' => 'Interior afelpado. Unisex. Tallas XS–XXL.', 'image' => '/images/defaults/ropa/serv-3.png'],
                        ],
                    ],
                    'gallery' => [
                        'items' => [
                            ['image' => '/images/defaults/ropa/photo-1.png', 'caption' => ''],
                            ['image' => '/images/defaults/ropa/photo-2.png', 'caption' => ''],
                            ['image' => '/images/defaults/ropa/photo-3.png', 'caption' => ''],
                            ['image' => '/images/defaults/ropa/photo-4.png', 'caption' => ''],
                            ['image' => '/images/defaults/ropa/photo-5.png', 'caption' => ''],
                            ['image' => '/images/defaults/ropa/photo-6.png', 'caption' => ''],
                        ],
                    ],
                ],
            ],

        ],
    ],

];
