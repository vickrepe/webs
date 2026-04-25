<?php

return [
    'sector'   => 'influencer',
    'sections' => [

        'hero' => [
            'required' => true,
            'label'    => 'Perfil',
            'fields'   => [
                'photo' => ['type' => 'image',    'label' => 'Foto de perfil',    'placeholder' => ''],
                'name'  => ['type' => 'text',     'label' => 'Nombre o @usuario', 'placeholder' => '@tuusuario'],
                'bio'   => ['type' => 'textarea', 'label' => 'Bio',               'placeholder' => 'Creadora de contenido · Moda & Lifestyle · Madrid'],
            ],
        ],

        'links' => [
            'required'   => true,
            'repeatable' => true,
            'label'      => 'Links',
            'fields'     => [
                'title' => ['type' => 'text', 'label' => 'Título', 'placeholder' => 'Mi último vídeo'],
                'url'   => ['type' => 'text', 'label' => 'URL',    'placeholder' => 'https://...'],
            ],
        ],

        'social' => [
            'required' => false,
            'label'    => 'Redes sociales',
            'fields'   => [
                'instagram' => ['type' => 'text', 'label' => 'Instagram',   'placeholder' => 'https://instagram.com/usuario'],
                'tiktok'    => ['type' => 'text', 'label' => 'TikTok',      'placeholder' => 'https://tiktok.com/@usuario'],
                'youtube'   => ['type' => 'text', 'label' => 'YouTube',     'placeholder' => 'https://youtube.com/...'],
                'twitter'   => ['type' => 'text', 'label' => 'Twitter / X', 'placeholder' => 'https://x.com/usuario'],
                'twitch'    => ['type' => 'text', 'label' => 'Twitch',      'placeholder' => 'https://twitch.tv/usuario'],
                'pinterest' => ['type' => 'text', 'label' => 'Pinterest',   'placeholder' => 'https://pinterest.com/usuario'],
            ],
        ],

    ],
];
