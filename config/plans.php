<?php

return [
    'free' => [
        'gallery_photos' => 15,
        'services'       => 5,
        'team_members'   => 10,
        'blog_posts'     => 5,
        'analytics'      => false,
        'reviews'        => false,
        'custom_domain'  => false,
    ],
    'basic' => [
        'gallery_photos' => 15,
        'services'       => 15,
        'team_members'   => 10,
        'blog_posts'     => 25,
        'analytics'      => false,
        'reviews'        => true,
        'custom_domain'  => false,
    ],
    'pro' => [
        'gallery_photos' => PHP_INT_MAX,
        'services'       => PHP_INT_MAX,
        'team_members'   => PHP_INT_MAX,
        'blog_posts'     => PHP_INT_MAX,
        'analytics'      => true,
        'reviews'        => true,
        'custom_domain'  => true,
    ],
];
