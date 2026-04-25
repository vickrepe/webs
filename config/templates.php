<?php

/*
|--------------------------------------------------------------------------
| Template registry
| Añadir un sector = añadir una línea aquí + el archivo en /templates/
| Compatible con config:cache (sin glob ni scandir en tiempo de ejecución)
|--------------------------------------------------------------------------
*/

return [
    'barbershop' => require __DIR__ . '/templates/barbershop.php',
    // 'restaurant' => require __DIR__ . '/templates/restaurant.php',
];
